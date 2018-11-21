(function( $ ){

  "use strict";

  $.fn.daysOfWeekInput = function() {
    return this.each(function(){
      var $field = $(this);
      
      var days = [
        {
          Name: 'Lu',
          Value: '1',
          Checked: false
        },
        {
          Name: 'Ma',
          Value: '2',
          Checked: false
        },
        {
          Name: 'Mi',
          Value: '3',
          Checked: false
        },
        {
          Name: 'Ju',
          Value: '4',
          Checked: false
        },
        {
          Name: 'Vi',
          Value: '5',
          Checked: false
        },
        {
          Name: 'Sa',
          Value: '6',
          Checked: false
        },
        {
          Name: 'Do',
          Value: '7',
          Checked: false
        }
      ];
      
      var currentDays = $field.val().split('');
      for(var i = 0; i < currentDays.length; i++) {
        var dayA = currentDays[i];
        for(var n = 0; n < days.length; n++) {
          var dayB = days[n];
          if(dayA === dayB.Value) {
            dayB.Checked = true;
          }
        }
      }
      
      // Make the field hidden when in production.
      //$field.attr('type','hidden');
      
      var options = '';
      var n = 0;
      while($('.days' + n).length) {
        n = n + 1;
      }
      
      var optionsContainer = 'days' + n;
      $field.before('<div class="days ' + optionsContainer + '"></div>');
      
      for(var i = 0; i < days.length; i++) {
        var day = days[i];
        var id = 'day' + day.Name + n;
        var checked = day.Checked ? 'checked="checked"' : '';
        options = options + '<div><input type="checkbox" value="' 
            + day.Value + '" id="' + id + '" ' + checked + ' />'
            + '<input type="text" id="hour'+day.Value+'" class="range-hour"/>'
            + '<label for="' + id + '">' + day.Name + '</label>&nbsp;&nbsp;</div>';
      }
      
      $('.' + optionsContainer).html(options);
      
      $('body').on('change', '.' + optionsContainer + ' input[type=checkbox]', function () {
        var value = $(this).val();
        var index = getIndex(value);
        $("#hour"+value).focus();
        if(this.checked) {

          updateField(value, index);
        } else {
          updateField(' ', index);
        }
      });
      
      function getIndex(value) {
        for(i = 0; i < days.length; i++) {
          if(value === days[i].Value) {
            return i;
          }
        }
      }
      
      function updateField(value, index) {
        //AQUI DEBO AÑADIR ALGO
        $field.val($field.val().substr(0, index) + value + $field.val().substr(index+1)).change();
      }
    });
  }
  
})( jQuery );

$('.days-of-week').daysOfWeekInput();