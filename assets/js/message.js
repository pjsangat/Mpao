function message(message,ctype)
	{
		$.bootstrapGrowl(message, {
			  ele: 'body', // which element to append to
			  type: ctype, // (null, 'info', 'error', 'success')
			  offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
			  align: 'center', // ('left', 'right', or 'center')
			  width: 'auto', // (integer, or 'auto')
			  delay: 4000,
			  allow_dismiss: true,
			  stackup_spacing: 10 // spacing between consecutively stacked growls.
		});
   	}