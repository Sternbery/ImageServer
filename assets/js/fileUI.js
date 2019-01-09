function getId(id){
	return document.getElementById(id);
}

function newElem(type,attributes){
	var elem = document.createElement(type);
	putAttr(elem,attributes);
	return elem;
}
function newPutElem(type,child,attributes){
	var elem = newElem(type,attributes);
	elem.appendChild(child);
	return elem;
}

function putAttr(elem,attributes){
	for(var key in attributes){
		elem.setAttribute(key,attributes[key]);
	}
}
function putAttrId(id,attributes){
	var elem = getId(id);
	putAttr(elem,attributes);
	return elem;
}

function newDiv(id,cls,attributes){
	if(id)	attributes['id'] += ' '+id;
	if(cls)	attributes['class'] += ' '+cls;
	return newElem('DIV',attributes);
}

function newInput(type, name,value,attributes){
	if(type)  attributes['type']=type;
	if(name)  attributes['name']=name;
	if(value) attributes['value']=value;
	return newElem('input',attributes);
}

function newFileInput(name,attributes){
	return newInput('file',name,'',attributes);
}

function newPutDiv(id,cls,child,attributes){
	var div =newDiv(id,cls,attributes);
	div.appendChild(child);
	return div;
}

function putId(id,child){
	getId(id).appendChild(child);
}