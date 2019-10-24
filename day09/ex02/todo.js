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
	var node = document.createElement("div");
	var textnode = document.createTextNode(text);
	node.className = "todo"
	node.appendChild(textnode);
	node.addEventListener("click", del_todo);
	var mother = document.getElementById("ft_list");
	mother.insertBefore(node, mother.childNodes[0]);
	setcookie(text);
}
function del_todo()
{
	if (confirm("vous souhaitez supprimer ce to do?"))
	{
		this.parentElement.removeChild(this);
		var remove = "|" + encodeURIComponent(this.innerHTML);
		new_cook = document.cookie.replace(remove, "");
		document.cookie = new_cook;
	}
}
