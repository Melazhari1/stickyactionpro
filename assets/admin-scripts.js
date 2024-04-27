// JavaScript for adding/removing blocks

function addBlock() {
	// Default options
	IconPicker.Init({
		jsonUrl: '/wp-content/plugins/stickyactionpro/assets/iconpicker/iconpicker-1.5.0.json',
		searchPlaceholder: 'Search Icon',
		showAllButton: 'Show All',
		cancelButton: 'Cancel',
		noResultsFound: 'No results found.', // v1.5.0 and the next versions
		borderRadius: '20px', // v1.5.0 and the next versions
	});
	let countBlock = document.querySelectorAll('#blocks-container .block').length + 1;
	const blocksContainer = document.getElementById('blocks-container');
	const newBlock = document.createElement('div');
	const txtColor = document.querySelector('#txtcolor').value;
	const bgColor = document.querySelector('#bgcolor').value;
	const style = 'style="color:' + txtColor + ';background-color:' + bgColor + ';border-color:' + txtColor + '"';
	newBlock.className = 'block';
	newBlock.innerHTML = `
		<div class="remove">
			<button class="remove-btn" onclick="removeBlock(this)"><i class="fa-solid fa-xl fa-close"></i></button>
		</div>
		<div class="groups">
			<div class="group">
				<input type="text" class="title" onclick="openWPLink(` + countBlock + `)" id="text_` + countBlock + `" onkeyup="preview()" readonly="" placeholder="text" name="text[]">
			</div>
			<div class="group">
				
				<input type="url"  class="link" onclick="openWPLink(` + countBlock + `)" id="url_` + countBlock + `" onkeyup="preview()" readonly="" placeholder="text" name="url[]">
			</div>
			<div class="group">
				<button ` + style + ` type="button" class="GetIconPicker" data-iconpicker-input="input.IconInput` + countBlock + `" ><i class="fas fa-phone"></i></button>
				<input type="hidden" class="IconInput` + countBlock + ` icon" value="fas fa-phone" name="icon[]">
			</div>
		</div>
	`;


	blocksContainer.appendChild(newBlock);
	IconPicker.Run('.GetIconPicker', function () {

		if ($('input.icon').length > 0) {
			$('input.icon').each(function (i, e) {
				const icon = $(e).val();
				$(e).prev().find('i').removeAttr('class');
				$(e).prev().find('i').attr('class', icon);
			})
		}
		document.querySelector('#IconPickerModal').remove();
	});
	setTimeout(function () {
		newBlock.classList.add('show');
	}, 10);
	preview();
}

IconPicker.Init({
	jsonUrl: '/wp-content/plugins/stickyactionpro/assets/iconpicker/iconpicker-1.5.0.json',
	searchPlaceholder: 'Search Icon',
	showAllButton: 'Show All',
	cancelButton: 'Cancel',
	noResultsFound: 'No results found.', // v1.5.0 and the next versions
	borderRadius: '20px', // v1.5.0 and the next versions
});

IconPicker.Run('.GetIconPicker', function () {

	if ($('input.icon').length > 0) {
		$('input.icon').each(function (i, e) {
			const icon = $(e).val();
			$(e).prev().find('i').removeAttr('class');
			$(e).prev().find('i').attr('class', icon);
		})
	}
	document.querySelector('#IconPickerModal').remove();
});
function saveAction() {
	const txtColor = $('#txtcolor').val();
	const bgcolor = $('#bgcolor').val();
	const size = $('#size').val();
	let blocks = [];
	$('#blocks-container .groups').each(function() {
		blocks.push({
			'title':$(this).find('.title').val(),
			'link':$(this).find('.link').val(),
			'icon':$(this).find('.icon').val()
		});
	});

	$.ajax({
		type: "post",
		url: customAjax.ajaxurl,
		data: {
			action:"save_action",
			txtcolor:txtColor,
			bgcolor:bgcolor,
			size:size,
			blocks:blocks
		},
		dataType: "json",
		beforeSend:function(){
			$('.save-btn').addClass('disabled-btn').attr('disabled','disabled');
		},
		success: function (response) {
			$('.save-btn').removeClass('disabled-btn').removeAttr('disabled');
		}
	});
}

function removeBlock(btn) {
	var block = btn.parentNode.parentNode;
	block.classList.remove('show');
	setTimeout(function () {
		var blocksContainer = document.getElementById('blocks-container');
		blocksContainer.removeChild(block);
	}, 50); // Delay added to match the transition duration
	preview();
}

const inputBgColor = document.querySelector('#bgcolor');
const inputTxtColor = document.querySelector('#txtcolor');
inputTxtColor.onchange = inputBgColor.onchange = function () {
	const buttons = document.querySelectorAll('#blocks-container .block button.GetIconPicker');
	const bgColor = inputBgColor.value;
	const txtColor = inputTxtColor.value;

	buttons.forEach(function (element) {
		let style = 'color:' + txtColor + ';background-color:' + bgColor + ';border-color:' + txtColor;
		element.removeAttribute('style');
		element.setAttribute('style', style);
	});

	preview();
}
document.addEventListener('click', function (event) {
	var iconPickerButton = event.target.closest('.GetIconPicker');

	if (iconPickerButton) {
		var iconPickerModal = document.querySelector('#IconPickerModal');

		if (iconPickerModal) {
			iconPickerModal.remove();
		}
	}
	preview();
});



document.querySelector('body input').onkeyup = function () {
	preview();
}


document.querySelector('#size').onchange = function () {
	this.previousElementSibling.textContent = "Size : ("+ this.value +"px)";
	preview();
}


function preview() {
	return '';
	const blocks = document.querySelectorAll('#blocks-container .block');
	const container = document.querySelector('.preview');
	const fontSize = document.querySelector('#size').value;
	container.textContent = '';
	const nav = document.createElement('nav');
	nav.setAttribute('style', 'background-color:' + inputBgColor.value + ';color:' + inputTxtColor.value);
	blocks.forEach(function (block) {
		const text = block.querySelector('.title').value;
		const url = block.querySelector('.link').value;
		const iconValue = block.querySelector('.icon').value;
		const button = document.createElement('a');
		const icon = document.createElement('i');
		button.textContent = text;
		button.setAttribute('href', url);
		button.setAttribute('style', 'border-color:' + inputTxtColor.value + ';color:' + inputTxtColor.value + ';font-size:' + fontSize + 'px;');
		icon.setAttribute('class', iconValue);
		button.appendChild(icon);
		nav.appendChild(button);
	});
	container.appendChild(nav);
}
preview();
// Create a hidden text area for wpLink to interact with
var $linkArea = $('<textarea id="hidden-wplink-textarea" style="display:none;"></textarea>').appendTo('body');

let fieldsId = null;
// Function to open wpLink
function openWPLink(id) {
	wpActiveEditor = 'hidden-wplink-textarea'; // Set the active editor to our hidden textarea
	fieldsId = id;

	if (typeof wpLink !== 'undefined') {
		wpLink.open();
		$('#wp-link-url').val(''); // Clear any previous values
	} else {
		console.error('wpLink not defined.');
	}
}
document.body.addEventListener('click', function(event) {
    // Check if the clicked element has the ID 'wp-link-submit'
    if (event.target.id === 'wp-link-submit') {
		const linkAtts = wpLink.getAttrs();
		document.querySelector('#text_'+fieldsId).value = document.querySelector('#wp-link-text').value;
		document.querySelector('#url_'+fieldsId).value = linkAtts.href;

        // Close the WordPress Link modal
        wpLink.close();

        event.preventDefault();
    }
});

jQuery(document).ready(function ($) {
	$('#add-button').click(function () {
		var newItem = '<div class="repeater-item"><input type="text" name="custom_input[]"/><button type="button" class="remove-button"><i class="fa-solid fa-circle-minus"></i>&nbsp;Remove</button></div>';
		$('#repeater').append(newItem);
		$('#repeater .repeater-item:last-child').hide().fadeIn();
	});
	$(document).on('click', '.remove-button', function () {
		var item = $(this).closest('.repeater-item');
		item.addClass('destroy');
		setTimeout(function () {
			item.remove();
		}, 500);
	});
});