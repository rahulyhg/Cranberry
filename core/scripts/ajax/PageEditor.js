var editorPageList = document.getElementById("pageList");
var editorMarkdown = document.getElementById("editorMD");
var editorHTML = document.getElementById("editorHTML");
var editorPageTitle = document.getElementById("pageTitle");

var activePage = null;

GetPageList();

function GetPageList(){
	Ajax('PageEditor', 'GetList', '', SetPageList);
}

/**
 * @return {string}
 */
function SetPageList_Format(id){
	return '<tr><td><a onclick="LoadPageInit(\'' + id + '\')">' + id + '</a></td></tr>';
}

function SetPageList(pageListRaw) {
	var pagesReq = pageListRaw.split('|')[0].split(',');
	var pagesUser = pageListRaw.split('|')[1].split(',');
	var pagesHTML = '<table class="table is-fullwidth"><thead></thead><tfoot></tfoot><tbody>';

	for(var i = 0; i < pagesReq.length; i++){
		pagesHTML += SetPageList_Format(pagesReq[i]);
	}

	for(var i = 0; i < pagesUser.length && pagesUser.length > 0; i++){
		pagesHTML +=  SetPageList_Format(pagesUser[i]);
	}

	pagesHTML += '</tbody></table>';

	editorPageList.innerHTML = pagesHTML;
}

function LoadPageInit(page) {
	activePage = page;

	Ajax('PageEditor', 'GetPage', 'page=' + page, LoadPageFinal);
}

function LoadPageFinal(pageRaw){
	var page = JSON.parse(pageRaw);

	editorMarkdown.innerText = page.bodyMarkdown;
	editorHTML.innerHTML = page.bodyHTML;
	editorPageTitle.innerHTML = 'Editing ' + page.name;

	editorMarkdown.disabled = false;
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