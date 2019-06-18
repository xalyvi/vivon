$(document).ready(function() {
    $('.mdb-select').materialSelect();
    });
    
function onStrictCheck() {
    let penalty = document.getElementById("penalty");
    let days = document.getElementById("penalty-days");
    let strict = document.getElementById('strict').checked;
    if (strict) {
        penalty.disabled = true;
        days.disabled = true;
    } else {
        penalty.disabled = false;
        days.disabled = false;
    }
}

function anyDate() {
    let date = document.getElementById('date').checked;
    if (document.getElementById('anyDay')) {
        date.disabled = true;
    } else {
        date.disabled = false;
    }
}

$('#points').on('change', function() {
    let inner = '<button id="next-criteria" type="submit" class="btn btn-cyan">Добавить новый критерий</button>';
    if (this.value + crit_sum <= 100)
        $('#modal-body').append(inner);
    else
        $('#next-criteria').remove();
  });

function onFileSelected(event) {
    let selectedFile = event.target.files[0];
    let reader = new FileReader();
    let form = document.forms['form_criteria'];
    let result = [];

    reader.onload = (event) => {
      result = CSVToArray(event.target.result);
      form.elements['code'].value = result[0][0];
      form.elements['name'].value = result[0][1];
      if (result[0][2].indexOf('любой') != -1) { form.elements['anyDay'].checked = true; onStrictCheck(); } else { form.elements['date'].value = result[0][2]; form.elements['anyDay'].value = false; }
      if (result[0][3].indexOf('Субъективный') != -1) {
          form.elements['Procedure'][0].checked = true;
      } else if (result[0][3].indexOf('Объективный') != -1) {
          form.elements['Objective'][1].checked = true;
      }
      form.elements['points'] = result[0][4];
      if (result[0][5].indexOf('строгий') != -1) {
          form.elements['strict'].checked = true;
          onStrictCheck();
      } else {
          form.elements['penalty-days'].value = result[0][5];
          form.elements['penalty'].value = result[0][6];
      }
    };
    reader.readAsText(selectedFile);
}




  function CSVToArray( strData, strDelimiter ){
      // Check to see if the delimiter is defined. If not,
      // then default to comma.
      strDelimiter = (strDelimiter || ",");

      // Create a regular expression to parse the CSV values.
      var objPattern = new RegExp(
          (
              // Delimiters.
              "(\\" + strDelimiter + "|\\r?\\n|\\r|^)" +

              // Quoted fields.
              "(?:\"([^\"]*(?:\"\"[^\"]*)*)\"|" +

              // Standard fields.
              "([^\"\\" + strDelimiter + "\\r\\n]*))"
          ),
          "gi"
          );


      // Create an array to hold our data. Give the array
      // a default empty first row.
      var arrData = [[]];

      // Create an array to hold our individual pattern
      // matching groups.
      var arrMatches = null;


      // Keep looping over the regular expression matches
      // until we can no longer find a match.
      while (arrMatches = objPattern.exec( strData )){

          // Get the delimiter that was found.
          var strMatchedDelimiter = arrMatches[ 1 ];

          // Check to see if the given delimiter has a length
          // (is not the start of string) and if it matches
          // field delimiter. If id does not, then we know
          // that this delimiter is a row delimiter.
          if (
              strMatchedDelimiter.length &&
              strMatchedDelimiter !== strDelimiter
              ){

              // Since we have reached a new row of data,
              // add an empty row to our data array.
              arrData.push( [] );

          }

          var strMatchedValue;

          // Now that we have our delimiter out of the way,
          // let's check to see which kind of value we
          // captured (quoted or unquoted).
          if (arrMatches[ 2 ]){

              // We found a quoted value. When we capture
              // this value, unescape any double quotes.
              strMatchedValue = arrMatches[ 2 ].replace(
                  new RegExp( "\"\"", "g" ),
                  "\""
                  );

          } else {

              // We found a non-quoted value.
              strMatchedValue = arrMatches[ 3 ];

          }


          // Now that we have our value string, let's add
          // it to the data array.
          arrData[ arrData.length - 1 ].push( strMatchedValue );
      }

      // Return the parsed data.
      return( arrData );
  }