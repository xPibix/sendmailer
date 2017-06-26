/**
 * Created by user on 26.06.2017.
 */
/*Editor*/
tinymce.init({
        selector: '#editor',
        height: 500,
        menubar: false,
        plugins: [
            'advlist autolink lists link charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
    });

/*Add Files Field*/
function add_input(){
    var inputs = $('.inputs input[type="file"]');
    var new_id = inputs.length+1;
    $('.inputs').append('<input type="file" name="file-'+new_id+'" />');
}
