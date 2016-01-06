function imagePreview() {
	$('#select-image').on('change', function(e) {
		e.preventDefault();
		if($(this)[0].files[0].size < 1048576) {
			var file, img;
		    if ((file = this.files[0])) {
		        
		        $('#crop-image').attr('src', URL.createObjectURL($(this)[0].files[0]));
		        $('#image-preview').attr('src', URL.createObjectURL($(this)[0].files[0]));
		    	$('#crop-image').Jcrop({
					onChange: updatePreview,
					onSelect: updatePreview,
					aspectRatio: xsize / ysize,
					bgOpacity:   .4,
					boxWidth: 450,
					minSize: [110, 89],
					setSelect:   [0, 0, 30, 19],
					
			    },function(){
			      // Use the API to get the real image size
			      var bounds = this.getBounds();
			      boundx = bounds[0];
			      boundy = bounds[1];
			      // Store the API in the jcrop_api variable
			      jcrop_api = this;

			      // Move the preview into the jcrop container for css positioning
			      $preview.appendTo(jcrop_api.ui.holder);
			    });
		    }
		}
		else {
			alert('File size larger than 1 MB.')
		}
	});
}

function setEventSubmitForm() {
	$('#jcrop-from').off('submit');
	$('#jcrop-from').on('submit', function(e) {
		e.preventDefault();
		if (true) {
			$.ajax({
				'type'	:	'post',
				'url'	:	'crop.php',
				// 'data'	:	JSON.stringify(req)
				data: new FormData($(this).get(0)),
		    	processData: false,
				contentType: false

			}).done(function(res) {
				console.log(res);
				res = $.parseJSON(res);
				if(res.status == 1) {
					Category.fetchAllCategories();
					alert(res.message);
					$('#add-category-modal').modal('hide');
					setTimeout(function() {document.location = "manage-category.php";}, 1000);
				}
				else {
					alert(res.message);
					
				}
			});
		};
	});

}