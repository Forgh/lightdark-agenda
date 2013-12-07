function checkSiblings(target) {
    var siblingsChecked = 0;
    target.parent('li').siblings('li').children('input').each(function(i, el){
        if ($(el).is(':checked')) {
            siblingsChecked++;
        }
    });
    
    if (siblingsChecked === 0) {
        var possibleParent = target.parent('li').parents('li').eq(0).children('input');
        if (possibleParent.length) {
            possibleParent.prop('checked', false);
        }

    }
}

$(document).ready(function()
{
	$('.cat_check').on('click', function (ev) {
		if ($(this).is(':checked')) {
			// check tous les enfants
			$(this).parent('li').each(function(i, el){
				$(el).find('input').prop('checked', true);
			});
			// check tous les parents au-dessus
			$(this).parents('li').each(function(i, el){
				$(el).children('input').prop('checked', true);
			});
		}
		else {
			$(this).parent('li').find('input').prop('checked', false);
			checkSiblings($(this));
		}
	});
});