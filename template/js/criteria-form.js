var innerDead = '<div id="deadline-dday" class="col-md-4 col-12"><div class="custom-control custom-checkbox ml-4"><input type="checkbox" class="custom-control-input" name="strict" id="strict"><label class="custom-control-label" for="strict" style="cursor: pointer;">Дедлайн в день начало проверки</label></div></div>';

$('.datepicker').pickadate({
    monthsFull: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    monthsShort: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Няб', 'Дек'],
    weekdaysFull: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
    weekdaysShort: ['Вос', 'Пон', 'Втор', 'Сред', 'Четв', 'Пятн', 'Суб'],
    format: 'd mmmm, yyyy',
    formatSubmit: 'yyyy-mm-dd',
    hiddenName: true
});

$(document).ready(function() {
    $('.mdb-select').materialSelect();
    var dateeval = $('#evalday').pickadate().pickadate('picker');
    $('#evalday').pickadate('picker').set('min', new Date( Date.now() + 30 * 24 * 60 * 60 * 1000));
    $('#evalday').pickadate('picker').on('set', function (event) {
        if (event.select) {
            if (!$('#deadline-dday').length && !$('#anyDay').checked) {
                $('#deadline-row').append(innerDead);
                $('#strict').on('change', function() {
                    if (this.checked) {
                        let now = new Date(dateeval.get('select')['pick']);
                        $('#deadline').prop("disabled", true);
                        $('#deadline').pickadate('picker').set('min', now);
                        $('#deadline').pickadate('picker').set('max', now);
                        $('#deadline').pickadate('picker').set('select', now);
                    }
                    else
                        $('#deadline').prop("disabled", false);
                        $('#deadline').pickadate('picker').set('min', new Date (dateeval.get('select')['pick'] + 24 * 60 * 60 * 1000));
                });
            }
            if (document.getElementById('deadline').disabled)
                document.getElementById('deadline').disabled = false;
                if ($('#strict').prop("checked") == false)
                {
                    $('#deadline').pickadate('picker').set('min', new Date (dateeval.get('select')['pick'] + 24 * 60 * 60 * 1000));
                }
                $('#deadline').pickadate('picker').set('max', new Date (dateeval.get('select')['pick'] + 30 * 24 * 60 * 60 * 1000));
            if ($('#strict').prop("checked") || !$('#deadline').pickadate('picker').get('select') || $('#deadline').pickadate('picker').get('select')['pick'] < dateeval.get('select')['pick']) {
                $('#deadline').pickadate('picker').set('select', new Date(dateeval.get('select')['pick']));
            }
        } else if ('clear' in event) {
            document.getElementById('deadline').disabled = true;
        }
      });
    $('#anyDay').on('change', function () {
        if (this.checked) {
            $('#evalday').prop("disabled", true);
            $('#deadline').prop("disabled", true);
            $('#deadline-dday').remove();
        } else {
            $('#evalday').prop("disabled", false);
            $('#deadline').prop("disabled", false);
            if (!$('#deadline-dday').length && dateeval.get('select') != null)
            {
                $('#deadline-row').append(innerDead);
                $('#strict').on('change', function() {
                    $('#deadline').prop("disabled", true);
                    $('#deadline').pickadate('picker').set('select', new Date(dateeval.get('select')['pick']));
                });
            }
        }
    });
});


$('#points').on('change', function() {
    let inner = '<button id="next-criteria" name="next-criteria" type="submit" class="btn btn-cyan">Добавить новый критерий</button>';
    if (parseInt(this.value)+parseInt(crit_sum) < 100) {
        if (!$('#next-criteria').length)
            $('#modal-body').append(inner);
    }
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