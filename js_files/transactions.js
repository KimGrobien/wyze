var table;
var transactionIndex = 2;
var categories = {"Food":"Food", "Entertainment": "Entertainment", "Gas":"Gas", 
    "Utilities":"Utilities", "Rent":"Rent", "Other":"Other"};
var dblClick = false;

function translateColumnName(columnName) {
    var translatedName;
    switch (columnName) {
        case "Name":
            translatedName = "Description";
            break;
        case "Cost":
            translatedName = "Amount";
            break;
    }
    return translatedName;
}

function fakeClick(){
    document.getElementById('inFile').click();
}

function readFile(o){
    fr = new FileReader();
    fr.onload = function(e){
        dataString = fr.result;
        parseFile(dataString)
    }
    fr.readAsBinaryString(o.files[0]);
}

function parseFile(binaryContents) {
    const binaryType = {
        type: 'binary'
    };
    var csvStrings = [];
    var workbook = XLSX.read(binaryContents, binaryType);
    workbook.SheetNames.forEach(function(name){
        csvStrings.push(XLSX.utils.sheet_to_csv(workbook.Sheets[name]));
    });
    parseSingleCSV(csvStrings[0]);
}

function parseSingleCSV(csvString) {
    var numOfRows = 0;
    var numOfColumns = 1;
    var ch, i;
    //Count rows
    for (i = 0; i < csvString.length; i++) {
        ch = csvString.charAt(i);
        if (ch === '\n') {
            numOfRows++
        }
    }
    //Count columns
    ch = '';
    i = 0;
    while (ch !== '\n') {
        ch = csvString.charAt(i);
        if (ch === ',') {
            numOfColumns++;
        }
        i++;
    }
    //Create 2D array to hold xlsx data
    var data = new Array(numOfRows);
    for (i = 0; i < numOfRows; i++) {
        data[i] = new Array(numOfColumns);
    }
    //Fill array
    for (i = 0; i < data.length; i++) {
        var rows = csvString.split("\n");
        data[i] = rows[i].split(",");
    }
    addImportedDataToTable(data);
}

function addImportedDataToTable(data){
    var dateColIdx, descColIdx, amountColIdx;
    for(var i = 0; i < data[0].length; i ++){
        switch (data[0][i]) {
            case "Amount":
                amountColIdx = i;
                break;
            case "Debit":
                amountColIdx = new Array(2);
                amountColIdx[0] = i;
                break;
            case "Credit": 
                amountColIdx[1] = i;
                break;
            case "Date":
                dateColIdx = i;
                break;
            case "Description":
                descColIdx = i;
                break;
        }
    }

    var date, description, amount;
    for (var i = 1; i < data.length; i++){
        date = data[i][dateColIdx]
        description = data[i][descColIdx]
        if (amountColIdx.constructor === Array){
            if (data[i][amountColIdx[0]] != ""){
                //Debit, thus negative amount
                amount = "-" + data[i][amountColIdx[0]];
            }else{
                amount = data[i][amountColIdx[1]];
            }
        }else{
            amount = data[i][amountColIdx];
        }
        //Add row
        if (amount != "") {
            transactionIndex++;
            table.addRow({id:transactionIndex, date: moment(date).format("MM/DD/YYYY"), description:description, category:"", amount:Number(amount).toFixed(2)}, true);
        }
    }
}

function addTransaction(){
    var dateVal = document.getElementById('inDate').value;
    var descVal = document.getElementById('inName').value;
    var categoryVal = document.getElementById('inCategory').value;
    var amountVal = document.getElementById('inAmount').value;
    if ((dateVal == "") || (descVal == "") || (categoryVal == "") || (amountVal == "")){
        alert("Please enter values for each field.");
    }else{
        transactionIndex++;
        table.addRow({id:transactionIndex, date: moment(dateVal).format("MM/DD/YYYY"), description:descVal, category:categoryVal, amount:amountVal}, true);
    }
}

function addTable(){
    var tabledata = [
        {id:1, date:moment("9/20/2018").format("MM/DD/YYYY"), description:"Chick-fil-A", category:"Food", amount:"7.93"},
        {id:2, date:moment("10/03/2018").format("MM/DD/YYYY"), description:"Marathon", category:"Gas", amount:"31.50"},
    ];

    table = new Tabulator("#tableDiv", {
        data:tabledata, //load initial data into table
        layout:"fitColumns", //fit columns to width of table (optional)
        columns:[ //Define Table Columns
            {title:"Transaction", field:"id", sorter:"number", align:"left", editor: false},
            {title:"Date", field:"date", sorter:"date", format: "MM/DD/YYYY", align:"left", editor: true, editable: editCheck},
            {title:"Description", field:"description", sorter:"string", align:"left", editor: true, editable: editCheck},
            {title:"Category", field:"category", sorter:"string", align:"left", editor: "select", editorParams:categories},
            {title:"Amount", field:"amount", sorter:"number", align:"left", editor: true, editable: editCheck},
            {formatter:"tickCross", width:40, align:"center", cellClick:function(e, cell){
                if (confirm("Are you sure you want to delete this transaction?")) {
                    table.deleteRow(cell.getRow());
                }
            }},
        ],
        cellDblClick:function(e, cell){
            //Editable on triple click
                dblClick = true;
        },
    });
    
}

function editCheck(){
    if (dblClick) {
        dblClick = false;
        return true;
    }else{
        return false;
    }
}