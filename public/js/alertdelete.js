/**
 * Created by kenneth on 10/25/2017.
 */
$('.delete').on('click',function(e){
    if(!confirm('Confirm Delete?')){
        e.preventDefault();
    }
});