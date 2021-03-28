jQuery(document).ready(function($){
    //$('#produtos_relacionados').multiSelect({

    var mu_fields_course = $('.course_related_galleries');

    $.each( mu_fields_course , function(key, value) {
        console.log( '#' + $(value).attr( 'id') );
        jQuery( '#' + jQuery(value).attr( 'id') ).multiSelect({
          selectableHeader: "<label>Não relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          selectionHeader: "<label>Relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 =
            $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
              if (e.which === 40){
                that.$selectableUl.focus();
                return false;
              }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
              if (e.which == 40){
                that.$selectionUl.focus();
                return false;
              }
            });
          },
          afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
          },
          afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
          }
        });
    });

    //$('#produtos_relacionados').multiSelect({

    var mu_fields_course_teacher = $('.teacher_galleries');

    $.each( mu_fields_course_teacher , function(key, value) {
        console.log( '#' + $(value).attr( 'id') );
        jQuery( '#' + jQuery(value).attr( 'id') ).multiSelect({
          selectableHeader: "<label>Não relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          selectionHeader: "<label>Relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 =
            $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
              if (e.which === 40){
                that.$selectableUl.focus();
                return false;
              }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
              if (e.which == 40){
                that.$selectionUl.focus();
                return false;
              }
            });
          },
          afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
          },
          afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
          }
        });
    });

    var mu_fields_course_related_courses = $('.course_related_courses');
    $.each( mu_fields_course_related_courses , function(key, value) {
        console.log( '#' + $(value).attr( 'id') );
        jQuery( '#' + jQuery(value).attr( 'id') ).multiSelect({
          selectableHeader: "<label>Não relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          selectionHeader: "<label>Relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 =
            $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
              if (e.which === 40){
                that.$selectableUl.focus();
                return false;
              }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
              if (e.which == 40){
                that.$selectionUl.focus();
                return false;
              }
            });
          },
          afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
          },
          afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
          }
        });
    });

    /*
    var mu_fields_course = $('.event_related_galleries');
    $.each( mu_fields_course , function(key, value) {
        console.log( '#' + $(value).attr( 'id') );
        jQuery( '#' + jQuery(value).attr( 'id') ).multiSelect({
          selectableHeader: "<label>Não relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          selectionHeader: "<label>Relacionados</label><br/><input type='text' class='search-input' autocomplete='off' placeholder='Filtrar por nome'>",
          afterInit: function(ms){
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

            that.qs1 =
            $selectableSearch.quicksearch(selectableSearchString)
            .on('keydown', function(e){
              if (e.which === 40){
                that.$selectableUl.focus();
                return false;
              }
            });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
            .on('keydown', function(e){
              if (e.which == 40){
                that.$selectionUl.focus();
                return false;
              }
            });
          },
          afterSelect: function(){
            this.qs1.cache();
            this.qs2.cache();
          },
          afterDeselect: function(){
            this.qs1.cache();
            this.qs2.cache();
          }
        });
    });
    */

});


jQuery(document).ready(function($){
    //$('#produtos_relacionados').multiSelect({
    if( jQuery( '#event_date').length > 0 ){
        var dateMask2 = new DateMask("dd/MM/yyyy HH:mm", "event_date");
        dateMask2.validationMessage = 'Data inválida, por favor verifique.';
    }

    $('.date_mask').inputmask("99/99/9999 99:99");

});
