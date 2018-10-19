function Popup(type, title, message){
	this.type = type;
	this.title = title;
	this.message = message;

	this.Show = function() {
		var body = document.body;
		var popup = document.createElement('div');
		var id = 'popup-' + Math.floor(Math.random() * 1001);
		var closeCode = 'document.getElementById(\'' + id + '\').remove();';

		popup.setAttribute('class', 'modal is-active');
		popup.setAttribute('id', id);

		popup.innerHTML = '<div class="modal-background" onclick="' + closeCode + '"></div><div class="modal-card"><header class="modal-card-head"><p class="modal-card-title">' + this.title + '</p><button class="delete" aria-label="close" onclick="' + closeCode + '"></button></header><section class="modal-card-body">' + this.message + '</section></div>';

		body.appendChild(popup);
	};
}