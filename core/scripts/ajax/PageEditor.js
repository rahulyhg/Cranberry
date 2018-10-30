var editorPageListReq = document.getElementById("pageListRequired");
var editorPageListUser = document.getElementById("pageListUser");
var editorMarkdown = document.getElementById("editorMD");
var editorHTML = document.getElementById("editorHTML");

var activePage = null;

GetPageList();

function GetPageList(){
	Ajax('PageEditor', 'GetList', '', SetPageList);
}

function SetPageList(pageListRaw) {
	//TODO: Format page list, interface with LoadPage()
}

function LoadPage(page) {
	//
}

var editorLastHTMLRefreshComplete = true;
editorMarkdown.onkeyup = function () {
	if(editorLastHTMLRefreshComplete){
		editorLastHTMLRefreshComplete = false;
		Ajax('PageEditor', 'GetHTML', 'markdown=' + editorMarkdown.value, UpdateEditorHTML);
	}
};

function UpdateEditorHTML(html) {
	editorHTML.innerHTML = html;
	editorLastHTMLRefreshComplete = true;
}