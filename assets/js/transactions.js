var table;
var transactionIndex = 2;
var dblClick = false;
var categories = JSON.parse(dbcategories);
var tabledata;

function convertDBToRows(){
    let data = new Array();
    for(var i = 0; i < transactions.length; i++){
        data.push({
            id: transactions[i][0],
            date: transactions[i][1],
            description: transactions[i][2],
            category: transactions[i][3],
            source: transactions[i][4],
            amount: transactions[i][5]
        })
    }
   /* let data = [
        {id:1, date:moment("9/20/2018").format("MM/DD/YYYY"), description:"Chick-fil-A", source: "cash", category:"Food and Dining", amount:"7.93"},
        {id:2, date:moment("10/03/2018").format("MM/DD/YYYY"), description:"Marathon", source: "creidt", category:"Gas and Fuel", amount:"31.50"},
    ];*/
 
    return data;
}

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
        parseFile(dataString);
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
    addImportedData(data);
}

function addImportedData(data){
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
    //Remove all credit transactions (ignore income)
    for (var i = 1; i < data.length; i++){
        if(data[i][amountColIdx[1]] != ""){
            data.splice(i, 1);
        }
    }
    var source = prompt("Please enter the source", "cash");
    addImportedDataToDB(data, source);
    var date, description, amount;
    for (var i = 1; i < data.length; i++){
        date = data[i][dateColIdx]
        description = data[i][descColIdx]
        amount = data[i][amountColIdx[0]];
        //Add row
        if (amount != "") {
            transactionIndex++;
            //table.addRow({id:transactionIndex, date: moment(date).format("MM/DD/YYYY"), description:description, source:source, amount:Number(amount).toFixed(2)}, true);
        }
    }
}

function addTransaction(){
    if ((dateVal == "") || (descVal == "") || (amountVal == "")){
        alert("Please enter values for each field.");
    }
}

function addTable(){
    tabledata = convertDBToRows();

    table = new Tabulator("#tableDiv", {
        data:tabledata, //load initial data into table
        layout:"fitColumns", //fit columns to width of table (optional)
        columns:[ //Define Table Columns
            {title:"Transaction", field:"id", sorter:"number", align:"left", editor: false},
            {title:"Date", field:"date", sorter:"date", format: "MM/DD/YYYY", align:"left", editor: true, editable: editCheck},
            {title:"Description", field:"description", sorter:"string", align:"left", editor: true, editable: editCheck},
            {title:"Category", field:"category", sorter:"string", align:"left", editor: "select", editorParams:categories},
            {title:"Source", field:"source", sorter:"string", align:"left", editor: "select", editorParams:categories},
            {title:"Amount", field:"amount", sorter:"number", align:"left", editor: true, editable: editCheck},
            {formatter:"tickCross", width:40, align:"center", cellClick:function(e, cell){
                if (confirm("Are you sure you want to delete this transaction?")) {
                    deleteFromDB(cell.getRow().getCell("id").getValue());
                    table.deleteRow(cell.getRow());
                }
            }},
        ],
         cellEdited:function(cell){
            updateInDB(cell.getRow().getCell("id").getValue(), cell.getColumn().getField(), cell.getValue());
        },
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