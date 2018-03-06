function modificaQ(_id){
	var value = document.getElementById(_id).value;
	document.getElementById(value).outerHTML="<span><input id='"+value+"' name='mQuantita' type='number' min='1' max='99' align='center'></input></span>";
	document.getElementById("form1").innerHTML+="<input type='hidden' value='"+document.getElementById('Codice'+value).innerHTML+"' name='mCodice'></input>";
	document.getElementById("form1").innerHTML+="<input type='hidden' value='"+document.getElementById('acquisto'+value).value+"' name='mProdotto'></input>";
	document.getElementById(_id).outerHTML="<button id='"+_id+"' type='submit' class='btn btn-default' >Applica</button>";
};
function eliminaA(_id){
		var value = document.getElementById(_id).value;
		document.getElementById("form1").innerHTML+="<input type='hidden' value='"+document.getElementById('acquisto'+value).value+"' name='aElimina'></input>";
		document.getElementById(_id).outerHTML="<button id='"+_id+"' type='submit' class='btn btn-default'>Conferma</button>";
};
function aggiungi(_id){
		var value = document.getElementById(_id).value;
		document.getElementById("form1").innerHTML+="<input type='hidden' value='"+document.getElementById('Codice'+value).innerHTML+"' name='aCodice'></input>";
		document.getElementById("quantita"+value).outerHTML="<span><input id='"+value+"' name='aQuantita' type='number' min='1' max='99' align='center'></input></span>";
		document.getElementById(_id).outerHTML="<button id='"+_id+"' type='submit' class='btn btn-default'>Conferma</button>";
};

(function(){
    'use strict';
	var $ = jQuery;
	$.fn.extend({
		filterTable: function(){
			return this.each(function(){
				$(this).on('keyup', function(e){
					$('.filterTable_no_results').remove();
					var $this = $(this),
                        search = $this.val().toLowerCase(),
                        target = $this.attr('data-filters'),
                        $target = $(target),
                        $rows = $target.find('tbody tr');

					if(search == '') {
						$rows.show();
					} else {
						$rows.each(function(){
							var $this = $(this);
							$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
						})
						if($target.find('tbody tr:visible').size() === 0) {
							var col_count = $target.find('tr').first().find('td').size();
							var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'"></td></tr>')
							$target.find('tbody').append(no_results);
						}
					}
				});
			});
		}
	});
	$('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
	$('[data-action="filter"]').filterTable();

	$('.container').on('click', '.panel-heading span.filter', function(e){
		var $this = $(this),
			$panel = $this.parents('.panel');

		$panel.find('.panel-body').slideToggle();
		if($this.css('display') != 'none') {
			$panel.find('.panel-body input').focus();
		}
	});
});
