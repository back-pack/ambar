// toggle css classes
var article_table_config = document.getElementsByClassName('config'), i;

function hide() {
    for (var i = 0; i < article_table_config.length; i ++) {
        article_table_config[i].classList.toggle('collapse');
    }
};

// toggle css classes
var article_table_profit = document.getElementsByClassName('profit'), i;

function hideProfit() {
    for (var i = 0; i < article_table_profit.length; i ++) {
        article_table_profit[i].classList.toggle('collapse');
    }
};

function date_hide() {
	$('#datee').toggle('hide');
}
