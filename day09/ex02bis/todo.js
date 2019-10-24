function prom()
{
	var text = prompt("to do ?");
	if (text != null)
	{
		text.trim();
		if (text != "")
			add_todo(text);
	}
}
function setcookie(text)
{
	var list = document.cookie;

	document.cookie = "";
	document.cookie = list + "|" + encodeURIComponent(text) + "; expires=Thu, 18 Dec 2020 12:00:00 UTC";
}
function loadcookie()
{
	var cook = document.cookie;
	document.cookie = "";
	var arr = cook.split("|");
	arr.forEach(function (e) {
		if (e != "")
			add_todo(decodeURIComponent(e));
	});
}
function add_todo(text)
{
	var textNode = document.createTextNode(text);
	var	div = $('<div>', { class: 'todo' });
	div.textCookie = text;
	div.append(textNode);
	div.click(del_todo);
	$("#ft_list").prepend(div);
	setcookie(text);
}
function del_todo()
{
	if (confirm("supprimer ?"))
	{
		$(this).remove();
		var remove = "|" + encodeURIComponent($(this).text());
		console.log($(this).text());
		var new_cook = document.cookie.replace(remove, "");
		document.cookie = new_cook;
	}
}
