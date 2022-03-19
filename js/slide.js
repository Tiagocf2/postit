//Variaveis globais
const CLASS_NAME = "slide"
const DEFAULT_INTERVAL = 5
var slideObjects = []

class SlideShow{
	constructor(o = null, int = DEFAULT_INTERVAL){
		this.instance = this;
		this._object = o;
		this.interval = int;
		this.activeImage = 0;
		if(this.isInstanceSet()){
			this.prepareImages()
			this.setTimer()
			this.addListener()
		}
	}
	set object(o){
		this._object = o;
	}
	get object(){
		return this._object;
	}
	
	isInstanceSet(){
		return this._object != null
	}
	//Separa os elementos IMG para usar no carrossel
	prepareImages(){
		if(!this.isInstanceSet())
			return false
		var slideChildren = this._object.childNodes;
		var slideImageNodes = [];
		for(var i = 0; i < slideChildren.length; i++){
			if(slideChildren[i].nodeName == "IMG")
				slideImageNodes.push(slideChildren[i]);
		}
		this.imageNodes = slideImageNodes;
		this.assignImageClasses();
		return true;
	}
	assignImageClasses(){
		for(var i = 0; i < this.imageNodes.length; i++){
			if(i == this.activeImage){
				this.imageNodes[i].classList.add("slide-on");
			}else{
				this.imageNodes[i].classList.add("slide-off");
			}
		}
	}
	//Funcao para trocar de Imagem
	nextSlide(){
		this.imageNodes[this.activeImage].classList.add(CLASS_NAME+"-off");
		this.imageNodes[this.activeImage].classList.remove(CLASS_NAME+"-on");
		this.activeImage++;
		if(this.activeImage >= this.imageNodes.length)
			this.activeImage = 0;
		this.imageNodes[this.activeImage].classList.add(CLASS_NAME+"-on");
		this.imageNodes[this.activeImage].classList.remove(CLASS_NAME+"-off");
		//A classe "on" e "off" determinam se a imagem esta ativa
	}

	//Coloca a funcao em um intervalo de 5 segundos
	setTimer(){
		var func = this.nextSlide;
		this.slideTimer = setInterval(func.bind(this.instance), this.interval * 1000);
	}
	//Detecta o evento de clique, renova o intervalo, e pula pra a proxima imagem	
	addListener(){
		var func = this.clickEvent;
		this._object.addEventListener("click", func.bind(this.instance));
	}
	clickEvent(){
		clearInterval(this.slideTimer);
		this.nextSlide();
		this.setTimer();
	}
}

function getSlideInstances(){
	return document.getElementsByClassName(CLASS_NAME);	
}
function createSlideObjects(){
	var slideElements = getSlideInstances();
	for(var i = 0; i < slideElements.length; i++){
		slideObjects.push(new SlideShow(slideElements[i]));
	}
}

createSlideObjects();