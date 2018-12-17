<script>
    $(document).on("click", ".open-AddBookDialog", function () {
        var myOrderId = $(this).data('id');
        $(".modal-body #orderId").val( myOrderId );
        $(".modal-body #orderfile").attr('name', 'file');
        // As pointed out in comments,
        // it is superfluous to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
</script>