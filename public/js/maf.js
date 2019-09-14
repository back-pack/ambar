// toggle css classes 
var article_table_config = document.getElementsByClassName('config'), i;

function hide() {
    for (var i = 0; i < article_table_config.length; i ++) {
        article_table_config[i].classList.toggle('collapse');
    }
};

function date_hide() {
	$('#datee').toggle('hide');
}

var delete_button = document.getElementsByClassName('trash_delete');
for(var x = 0; x < delete_button.length; x++) {
    delete_button[x].addEventListener("click", function(e) {
        e.preventDefault();
        var $id = this.id;
        var $entity = this.dataset.entity;
        alert($entity);
        $modal = document.getElementById('modal');
        $modal.style.display = 'block';
})};

function closeModal(element) {
    element.style.display = 'none';
}
