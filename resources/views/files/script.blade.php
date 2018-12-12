<script>
    Dropzone.options.dropzoneForm = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (Only CSV files can be uploaded.)",
        // parallelUploads: 5,
        // chunking: true,
        // acceptedFiles: '.csv',
        // autoProcessQueue: false,
        // autoQueue: false,
        init: function() {
        this.on("success", function(file) {
            swal({
                title: "Success!",
                text: "Uploaded Successfully",
                icon: "success",
                type: "success",
                button: "Dismiss.",
                });                
            });
        },
        error: function(file, response) {
        if($.type(response) === 400)
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message; // Else, we send our custom response message.
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
        }   

    };
</script>