<div id="code" >

    int main(){
        int n = 0;
        int m = n + 1;
        // condition checking
        if(m > 0){
            printf('welcome');
        }
        /*
            this is multiline comment
        */
    }

    int main(){
        int n = 0;
        int m = n + 1;
        // condition checking
        if(m > 0){
            printf('welcome');
        }
        /*
            this is multiline comment
        */
    }

    int main(){
        int n = 0;
        int m = n + 1;
        // condition checking
        if(m > 0){
            printf('welcome');
        }
        /*
            this is multiline comment
        */
    }
</div>


<style>
    body{
font-family: "euclid_circular_a","Source Sans Pro","Helvetica Neue","Helvetica","Arial",sans-serif;
font-size: 16px;
color: #fff;
background-color: #000000;
}
.templet{
       padding: 3px;
       border-radius: 4px;
       border: 1px solid #363737;
       color: #eeeef0;
       background-color: #080000;
       font-family: "Droid Sans Mono","Inconsolata","Menlo","Consolas","Bitstream Vera Sans Mono","Courier",monospace;
       font-size: 14px;
       line-height: 25px;
       margin: 2px;
}
table{
     padding: 3px;
     margin-bottom: 15px!important;
     border-radius: 4px;
     border: 1px solid #343535;
     background-color: #343535;
     color: #fff;
     font-family: "Droid Sans Mono","Inconsolata","Menlo","Consolas","Bitstream Vera Sans Mono","Courier",monospace;
     font-size: 15px;
     font-weight: bold;
     line-height: 30px;
     border-collapse: separate;
}
th{
  background-color: #a40606;
  border: 2px solid #a40606!important;
}
td{
    background-color: #a40606!important;
    border: 2px solid #a40606!important;
  }
tr {
    color: #fafafb;
}
caption{
  caption-side: top;
  color: #fff;
}
h1,h2,h3{
color: #f7f7fb;
}
h3{
  text-size = 12px !important;
}
hr{
  background: #fff;
}




.codetem{
    border-radius: 4px;
    border: 1px solid #393a3b;
	background-color: #000;
	padding: 10px;
}
.output{
  color: #f7f9fb;
  border-radius: 4px;
  border: 1px solid #363737;
  background-color: #000;
  padding: 10px;
}

img{
   width: 100%;
}
.fimg{
  width: 25px!important;
  height: 25px!important;
}
.dpd{
padding: 7px;
}
.footer{
  padding: 30px;
  text-align: center;
  background-color: #07011a;
  font-family: sans-serif;
  font-size: 12px;
}








.headerfile{
	color: #31ca3a;
}
.string{
	color: #66a5f7;
}
.keyword{
	color: #3109f4;
	font-weight: bold;
}
.other{
	color: #d70c0c;
}
.value{
	color:#f43dc7;
}
.comment{
	color: #8c7289;
}
.char{
	color: #7dccfb;
}
.nocolor{
	color: #f7d44f;
}
.buildin{
	color: #1fe3d1;
}

































.navbar.bg-light {
    background-color: #000 !important;
}
.navbar{

	opacity: 0.9;

}
.logo {
    height: 58px;
    width: 183px;
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none !important;
    float: left;
    min-width: 10rem;
    padding: .5rem 0;
    margin: .125rem 0 0;
    font-size: 1rem;
    color: #212529;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: .25rem;
}

.chack{
	height: 2000px;
     width: 700px;
		background-image: url('../img/aaa.jpg');
}
#showcase{
	width: 100%;
	margin-top: 72px;
	background-image: url('../img/aabut.jpg');
}
.primary-overlay{
	background: rgba(000, 000, 000, 0.6);
}
#whatare{

   background: white;

}
.outline{
	border: 1px solid light;
	border-radius: 10px;
}
hr{
	color: red;
}
.cont{
	width: 70%;
	margin: auto;
}
.fas{
	color: red;
	font-size: 30px;
}
#pictur{

	background: white;
}
.overlay{
	background: #bedef7;
	opacity: 0.9;
}
.cntt{
	width: 80%;
	margin: auto;

}
.card-body>p{
	font-size: 12px;
}
a{
	margin: 0 !important;
	text-decoration: none !important;
}
.fa-facebook{
	color: #0937a3 !important;
}
.fa-facebook-messenger{
	color: #0ee5ed !important;
}
.fa-google-plus{
	color: #f4138b !important;
}
.fa-twitter{
	color: #06b0db !important;
}
@media (max-width: 271px){
	#showcase{
	  margin-top: 123px;
    }
	.logo {
    height: 50px;
    width: 160px;
   }
   .hh1{
	   font-size: 30px !important;
   }
   .cont{
	width: 90%;
	margin: auto;
    }

}
.h6{
	font-size: 14px !important;
}
.btnn{
	font-size: 14px !important;
	border-radius: 15px !important;

}
.mrk{
	color: #f9f034;
}
</style>




<script>
    var myheading = document.querySelectorAll("[id='code']");
for(var el = 0; el < myheading.length; el++){
	var stng = myheading[el].innerHTML;
	var lnt = stng.length;
	var code="",cst="";
	var hs=0,mp=0,sq=0,dq=0,ds=0,ss=0,nm=0,ns=0;
	for(var i=0; i<lnt; i++){
	    if(dq==0&&ds==0&&ss==0&&stng[i]=='#'){hs=1;}
	    if(ds==0&&ss==0&&stng[i]=='"'){dq++;}
	    if(ds==0&&ss==0&&stng[i]=='\''){sq++;}
	    if(stng[i]=='/'&&stng[i+1]=='/'){ds=1;}
	    if(stng[i]=='/'&&stng[i+1]=='*'){ss=1;}
	    if((stng[i]=='0'||stng[i]=='1'||stng[i]=='2'||stng[i]=='3'||stng[i]=='4'||stng[i]=='5'||
	    	stng[i]=='6'||stng[i]=='7'||stng[i]=='8'||stng[i]=='9'||nm>0)&&sq==0&&dq==0&&ds==0&&ss==0){nm++;}
	    if(hs==1){
	      if(stng[i]==' '){code += "<code class='headerfile'>"+cst+"</code>";code += "<code>"+"\xa0"+"</code>";cst="";}
	      else if(stng[i]=='\n'){code += "<code class='headerfile'>"+cst+"</code>";cst="";code += "<br/>";hs=0;}
	      else if(stng[i]=='\t'){code += "<code class='headerfile'>"+cst+"</code>";cst="";code += "\t";}
	      else{cst += stng[i];}
	      if(i==lnt-1){code += "<code class='headerfile'>"+cst+"</code>";cst="";}
	    }
	    else if(sq!=0){
	    	if(stng[i]==' '){code += "<code class='char'>"+cst+"</code>";code += "<code>"+"\xa0"+"</code>";cst="";}
	        else if(stng[i]=='\n'){code += "<code class='char'>"+cst+"</code>";cst="";code += "<br/>";}
	        else if(stng[i]=='\t'){code += "<code class='char'>"+cst+"</code>";cst="";code += "\t";}
	        else{cst += stng[i];}

	        if(stng[i]=='\''||i==lnt-1){code += "<code class='char'>"+cst+"</code>";cst="";}
	        if(sq==2){sq=0;}
	    }
	    else if(dq!=0){
	    	if(stng[i]==' '){code += "<code class='string'>"+cst+"</code>";code += "<code>"+"\xa0"+"</code>";cst="";}
	        else if(stng[i]=='\n'){code += "<code class='string'>"+cst+"</code>";cst="";code += "<br/>";}
	        else if(stng[i]=='\t'){code += "<code class='string'>"+cst+"</code>";cst="";code += "\t";}
	        else{cst += stng[i];}

	        if(stng[i]=='"'||i==lnt-1){code += "<code class='string'>"+cst+"</code>";cst="";}
	        if(dq==2){dq=0;}
	    }
	    else if(ds==1){
	      if(stng[i]==' '){code += "<code class='comment'>"+cst+"</code>";code += "<code>"+"\xa0"+"</code>";cst="";}
	      else if(stng[i]=='\n'){code += "<code class='comment'>"+cst+"</code>";cst="";code += "<br/>";ds=0;}
	      else if(stng[i]=='\t'){code += "<code class='comment'>"+cst+"</code>";cst="";code += "\t";}
	      else{cst += stng[i];}
	      if(i==lnt-1){code += "<code class='comment'>"+cst+"</code>";cst="";}
	    }
	    else if(ss==1){
	    	if(stng[i]==' '){code += "<code class='comment'>"+cst+"</code>";code += "<code>"+"\xa0"+"</code>";cst="";}
	        else if(stng[i]=='\n'){code += "<code class='comment'>"+cst+"</code>";cst="";code += "<br/>";}
	        else if(stng[i]=='\t'){code += "<code class='comment'>"+cst+"</code>";cst="";code += "\t";}
	        else {cst += stng[i];}
	        if(stng[i]=='/'&&stng[i-1]=='*'){code += "<code class='comment'>"+cst+"</code>";cst="";ss=0;}
	        if(i==lnt-1){code += "<code class='comment'>"+cst+"</code>";cst="";}
	    }
	    else if(nm>0){
	        if(nm==1&&cst!=""){ns = 1;}
	    	if(!(stng[i]=='0'||stng[i]=='1'||stng[i]=='2'||stng[i]=='3'||stng[i]=='4'||stng[i]=='5'||
	    	stng[i]=='6'||stng[i]=='7'||stng[i]=='8'||stng[i]=='9')&&stng[i]!='.'){
	    	    if(ns==0){code += "<code class='value'>"+cst+"</code>";}
	    	    else{code += proces(cst);}
	    	    cst="";nm=0;ns=0;i--;
	    	}
	    	else {cst += stng[i];}
	    	if(i==lnt-1){code += "<code class='value'>"+cst+"</code>";cst="";}
	    }
	    else{

	       if(stng[i]=='&'&&stng[i+1]=='l'&&stng[i+2]=='t'&&stng[i+3]==';'){
	       	 code += proces(cst)+"<code class='other'>&lt;</code>"; i += 3;cst="";
	       }
	       else if(stng[i]=='&'&&stng[i+1]=='g'&&stng[i+2]=='t'&&stng[i+3]==';'){
	       	 code += proces(cst)+"<code class='other'>&gt;</code>"; i += 3;cst="";
	       }
	       else if(stng[i]=='&'&&stng[i+1]=='a'&&stng[i+2]=='m'&&stng[i+3]=='p'&&stng[i+4]==';'){
	       	 code += proces(cst)+"<code class='other'>&amp;</code>"; i += 4;cst="";
	       }
	       else if(
	       	 stng[i]==','||stng[i]=='.'||stng[i]=='='||
	         stng[i]=='('||stng[i]==')'||stng[i]==';'||
	       	 stng[i]=='$'||stng[i]==':'||stng[i]=='%'||
	       	 stng[i]=='['||stng[i]==']'||stng[i]=='#'||
	       	 stng[i]=='?'||stng[i]=='+'||stng[i]=='&'||
	       	 stng[i]=='{'||stng[i]=='}'||stng[i]=='"'||
	       	 stng[i]=='^'||stng[i]=='!'||stng[i]=='*'||
	       	 stng[i]=='/'||stng[i]=='|'||stng[i]=='-'||
	       	 stng[i]=='\\'||stng[i]=='~'||stng[i]=='−'||
	       	 stng[i]=='\''
	       	){code += proces(cst)+"<code class='other'>"+stng[i]+"</code>"; cst="";}
	       	else if(stng[i]==' '){code += proces(cst)+"<code>"+"\xa0"+"</code>";cst="";}
	        else if(stng[i]=='\n'){code += proces(cst)+"<br/>";cst="";}
	        else if(stng[i]=='\t'){code += proces(cst)+"\t";cst="";}
	        else{cst += stng[i];}
	        if(i==lnt-1){code += proces(cst);cst="";}
	    }
	}
	myheading[el].innerHTML = code;
}
function proces(prm){
	 if(
	 	prm=="auto"||prm=="double"||prm=="struct"||
	 	prm=="break"||prm=="else"||prm=="long"||
	 	prm=="switch"||prm=="case"||prm=="enum"||
	 	prm=="register"||prm=="typrdef"||prm=="char"||
	 	prm=="extern"||prm=="return"||prm=="union"||
	 	prm=="continue"||prm=="for"||prm=="signed"||
	 	prm=="void"||prm=="do"||prm=="if"||
	 	prm=="static"||prm=="while"||prm=="default"||
	 	prm=="goto"||prm=="sizeof"||prm=="volatile"||
	 	prm=="const"||prm=="float"||prm=="short"||
	 	prm=="unsigned"||prm=="int"||prm=="using"||
	 	prm=="namespace"||prm=="goto"
	 ){prm = "<code class='keyword'>"+prm+"</code>";}
	 else if(
	 	prm=="main"||prm=="scanf"||prm=="printf"||prm=="std"||
		prm=="vector"||prm=="pair"||prm=="push_back"||prm=="clear"||
		prm=="size"||prm=="begin"||prm=="end"||prm=="pop"||prm=="first"||
		prm=="second"||prm=="top"||prm=="string"
	 ){prm = "<code class='buildin'>"+prm+"</code>";}
	 else{prm = "<code class='nocolor'>"+prm+"</code>";}
	return prm;
}
</script>
