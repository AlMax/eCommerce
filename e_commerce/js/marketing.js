function aggiungiProdotto(){
	var table = document.getElementById("bodyT");
	var row = table.insertRow(0);
	var cell0 = row.insertCell(0);
	var cell1 = row.insertCell(1);
	var cell2 = row.insertCell(2);
	var cell3 = row.insertCell(3);
	var cell4 = row.insertCell(4);
	var cell5 = row.insertCell(5);
	cell0.innerHTML = "<td><span></span></td>";
	cell1.innerHTML = "<td><span><input name='aDenominazione' type='text' size='10' align='center'></input></span></td>";
	cell2.innerHTML = "<td><span><input name='aDescrizione' type='text' size='10' align='center'></input></span></td>";
	cell3.innerHTML = "<td><span><input name='aPrezzo' type='number' min='1' max='999' align='center'></input></span></td>";
	cell4.innerHTML = "<td><span><input name='aQuantita' type='number' min='1' max='99' align='center'></input></span></td>";
	cell5.innerHTML = "<td><button style='background-color:#d6e9c6;color:green;' type='submit' class='btn btn-default'>Aggiungi</button></td>";
};

function elimina(_id){
	var value = document.getElementById(_id).value;
	document.getElementById("form1").innerHTML+="<input type='hidden' value='"+document.getElementById('codice'+value).innerHTML+"' name='pElimina'></input>";
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
