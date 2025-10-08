<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
	xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
	xmlns:ccts="urn:un:unece:uncefact:documentation:2"
	xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001"
	xmlns:clm5639="urn:un:unece:uncefact:codelist:specification:5639:1988"
	xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001"
	xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003"
	xmlns:fn="http://www.w3.org/2005/xpath-functions" 
	xmlns:link="http://www.xbrl.org/2003/linkbase"
	xmlns:n1="urn:oasis:names:specification:ubl:schema:xsd:DespatchAdvice-2"
	xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2"
	xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2"
	xmlns:xbrldi="http://xbrl.org/2006/xbrldi" 
	xmlns:xbrli="http://www.xbrl.org/2003/instance"
	xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" 
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:xs="http://www.w3.org/2001/XMLSchema" 
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	exclude-result-prefixes="cac cbc ccts clm54217 clm5639 clm66411 clmIANAMIMEMediaType fn link n1 qdt udt xbrldi xbrli xdt xlink xs xsd xsi">
	<xsl:character-map name="a"> 
		<xsl:output-character character="&#128;" string=""/>
		<xsl:output-character character="&#129;" string=""/>
		<xsl:output-character character="&#130;" string=""/>
		<xsl:output-character character="&#131;" string=""/>
		<xsl:output-character character="&#132;" string=""/>
		<xsl:output-character character="&#133;" string=""/>
		<xsl:output-character character="&#134;" string=""/>
		<xsl:output-character character="&#135;" string=""/>
		<xsl:output-character character="&#136;" string=""/>
		<xsl:output-character character="&#137;" string=""/>
		<xsl:output-character character="&#138;" string=""/>
		<xsl:output-character character="&#139;" string=""/>
		<xsl:output-character character="&#140;" string=""/>
		<xsl:output-character character="&#141;" string=""/>
		<xsl:output-character character="&#142;" string=""/>
		<xsl:output-character character="&#143;" string=""/>
		<xsl:output-character character="&#144;" string=""/>
		<xsl:output-character character="&#145;" string=""/>
		<xsl:output-character character="&#146;" string=""/>
		<xsl:output-character character="&#147;" string=""/>
		<xsl:output-character character="&#148;" string=""/>
		<xsl:output-character character="&#149;" string=""/>
		<xsl:output-character character="&#150;" string=""/>
		<xsl:output-character character="&#151;" string=""/>
		<xsl:output-character character="&#152;" string=""/>
		<xsl:output-character character="&#153;" string=""/>
		<xsl:output-character character="&#154;" string=""/>
		<xsl:output-character character="&#155;" string=""/>
		<xsl:output-character character="&#156;" string=""/>
		<xsl:output-character character="&#157;" string=""/>
		<xsl:output-character character="&#158;" string=""/>
		<xsl:output-character character="&#159;" string=""/>
	</xsl:character-map> 
	<xsl:decimal-format name="european" decimal-separator="," grouping-separator="." NaN=""/>
	<xsl:output version="4.0" method="html" indent="no" encoding="UTF-8"
		doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN"
		doctype-system="http://www.w3.org/TR/html4/loose.dtd" use-character-maps="a"/>
	<xsl:param name="SV_OutputFormat" select="'HTML'"/>
	<xsl:variable name="XML" select="/"/>
	<xsl:template match="/">
		<html>
			<head>
				<script type="text/javascript">
					<![CDATA[var QRCode;!function(){function a(a){this.mode=c.MODE_8BIT_BYTE,this.data=a,this.parsedData=[];for(var b=[],d=0,e=this.data.length;e>d;d++){var f=this.data.charCodeAt(d);f>65536?(b[0]=240|(1835008&f)>>>18,b[1]=128|(258048&f)>>>12,b[2]=128|(4032&f)>>>6,b[3]=128|63&f):f>2048?(b[0]=224|(61440&f)>>>12,b[1]=128|(4032&f)>>>6,b[2]=128|63&f):f>128?(b[0]=192|(1984&f)>>>6,b[1]=128|63&f):b[0]=f,this.parsedData=this.parsedData.concat(b)}this.parsedData.length!=this.data.length&&(this.parsedData.unshift(191),this.parsedData.unshift(187),this.parsedData.unshift(239))}function b(a,b){this.typeNumber=a,this.errorCorrectLevel=b,this.modules=null,this.moduleCount=0,this.dataCache=null,this.dataList=[]}function i(a,b){if(void 0==a.length)throw new Error(a.length+"/"+b);for(var c=0;c<a.length&&0==a[c];)c++;this.num=new Array(a.length-c+b);for(var d=0;d<a.length-c;d++)this.num[d]=a[d+c]}function j(a,b){this.totalCount=a,this.dataCount=b}function k(){this.buffer=[],this.length=0}function m(){return"undefined"!=typeof CanvasRenderingContext2D}function n(){var a=!1,b=navigator.userAgent;return/android/i.test(b)&&(a=!0,aMat=b.toString().match(/android ([0-9]\.[0-9])/i),aMat&&aMat[1]&&(a=parseFloat(aMat[1]))),a}function r(a,b){for(var c=1,e=s(a),f=0,g=l.length;g>=f;f++){var h=0;switch(b){case d.L:h=l[f][0];break;case d.M:h=l[f][1];break;case d.Q:h=l[f][2];break;case d.H:h=l[f][3]}if(h>=e)break;c++}if(c>l.length)throw new Error("Too long data");return c}function s(a){var b=encodeURI(a).toString().replace(/\%[0-9a-fA-F]{2}/g,"a");return b.length+(b.length!=a?3:0)}a.prototype={getLength:function(){return this.parsedData.length},write:function(a){for(var b=0,c=this.parsedData.length;c>b;b++)a.put(this.parsedData[b],8)}},b.prototype={addData:function(b){var c=new a(b);this.dataList.push(c),this.dataCache=null},isDark:function(a,b){if(0>a||this.moduleCount<=a||0>b||this.moduleCount<=b)throw new Error(a+","+b);return this.modules[a][b]},getModuleCount:function(){return this.moduleCount},make:function(){this.makeImpl(!1,this.getBestMaskPattern())},makeImpl:function(a,c){this.moduleCount=4*this.typeNumber+17,this.modules=new Array(this.moduleCount);for(var d=0;d<this.moduleCount;d++){this.modules[d]=new Array(this.moduleCount);for(var e=0;e<this.moduleCount;e++)this.modules[d][e]=null}this.setupPositionProbePattern(0,0),this.setupPositionProbePattern(this.moduleCount-7,0),this.setupPositionProbePattern(0,this.moduleCount-7),this.setupPositionAdjustPattern(),this.setupTimingPattern(),this.setupTypeInfo(a,c),this.typeNumber>=7&&this.setupTypeNumber(a),null==this.dataCache&&(this.dataCache=b.createData(this.typeNumber,this.errorCorrectLevel,this.dataList)),this.mapData(this.dataCache,c)},setupPositionProbePattern:function(a,b){for(var c=-1;7>=c;c++)if(!(-1>=a+c||this.moduleCount<=a+c))for(var d=-1;7>=d;d++)-1>=b+d||this.moduleCount<=b+d||(this.modules[a+c][b+d]=c>=0&&6>=c&&(0==d||6==d)||d>=0&&6>=d&&(0==c||6==c)||c>=2&&4>=c&&d>=2&&4>=d?!0:!1)},getBestMaskPattern:function(){for(var a=0,b=0,c=0;8>c;c++){this.makeImpl(!0,c);var d=f.getLostPoint(this);(0==c||a>d)&&(a=d,b=c)}return b},createMovieClip:function(a,b,c){var d=a.createEmptyMovieClip(b,c),e=1;this.make();for(var f=0;f<this.modules.length;f++)for(var g=f*e,h=0;h<this.modules[f].length;h++){var i=h*e,j=this.modules[f][h];j&&(d.beginFill(0,100),d.moveTo(i,g),d.lineTo(i+e,g),d.lineTo(i+e,g+e),d.lineTo(i,g+e),d.endFill())}return d},setupTimingPattern:function(){for(var a=8;a<this.moduleCount-8;a++)null==this.modules[a][6]&&(this.modules[a][6]=0==a%2);for(var b=8;b<this.moduleCount-8;b++)null==this.modules[6][b]&&(this.modules[6][b]=0==b%2)},setupPositionAdjustPattern:function(){for(var a=f.getPatternPosition(this.typeNumber),b=0;b<a.length;b++)for(var c=0;c<a.length;c++){var d=a[b],e=a[c];if(null==this.modules[d][e])for(var g=-2;2>=g;g++)for(var h=-2;2>=h;h++)this.modules[d+g][e+h]=-2==g||2==g||-2==h||2==h||0==g&&0==h?!0:!1}},setupTypeNumber:function(a){for(var b=f.getBCHTypeNumber(this.typeNumber),c=0;18>c;c++){var d=!a&&1==(1&b>>c);this.modules[Math.floor(c/3)][c%3+this.moduleCount-8-3]=d}for(var c=0;18>c;c++){var d=!a&&1==(1&b>>c);this.modules[c%3+this.moduleCount-8-3][Math.floor(c/3)]=d}},setupTypeInfo:function(a,b){for(var c=this.errorCorrectLevel<<3|b,d=f.getBCHTypeInfo(c),e=0;15>e;e++){var g=!a&&1==(1&d>>e);6>e?this.modules[e][8]=g:8>e?this.modules[e+1][8]=g:this.modules[this.moduleCount-15+e][8]=g}for(var e=0;15>e;e++){var g=!a&&1==(1&d>>e);8>e?this.modules[8][this.moduleCount-e-1]=g:9>e?this.modules[8][15-e-1+1]=g:this.modules[8][15-e-1]=g}this.modules[this.moduleCount-8][8]=!a},mapData:function(a,b){for(var c=-1,d=this.moduleCount-1,e=7,g=0,h=this.moduleCount-1;h>0;h-=2)for(6==h&&h--;;){for(var i=0;2>i;i++)if(null==this.modules[d][h-i]){var j=!1;g<a.length&&(j=1==(1&a[g]>>>e));var k=f.getMask(b,d,h-i);k&&(j=!j),this.modules[d][h-i]=j,e--,-1==e&&(g++,e=7)}if(d+=c,0>d||this.moduleCount<=d){d-=c,c=-c;break}}}},b.PAD0=236,b.PAD1=17,b.createData=function(a,c,d){for(var e=j.getRSBlocks(a,c),g=new k,h=0;h<d.length;h++){var i=d[h];g.put(i.mode,4),g.put(i.getLength(),f.getLengthInBits(i.mode,a)),i.write(g)}for(var l=0,h=0;h<e.length;h++)l+=e[h].dataCount;if(g.getLengthInBits()>8*l)throw new Error("code length overflow. ("+g.getLengthInBits()+">"+8*l+")");for(g.getLengthInBits()+4<=8*l&&g.put(0,4);0!=g.getLengthInBits()%8;)g.putBit(!1);for(;;){if(g.getLengthInBits()>=8*l)break;if(g.put(b.PAD0,8),g.getLengthInBits()>=8*l)break;g.put(b.PAD1,8)}return b.createBytes(g,e)},b.createBytes=function(a,b){for(var c=0,d=0,e=0,g=new Array(b.length),h=new Array(b.length),j=0;j<b.length;j++){var k=b[j].dataCount,l=b[j].totalCount-k;d=Math.max(d,k),e=Math.max(e,l),g[j]=new Array(k);for(var m=0;m<g[j].length;m++)g[j][m]=255&a.buffer[m+c];c+=k;var n=f.getErrorCorrectPolynomial(l),o=new i(g[j],n.getLength()-1),p=o.mod(n);h[j]=new Array(n.getLength()-1);for(var m=0;m<h[j].length;m++){var q=m+p.getLength()-h[j].length;h[j][m]=q>=0?p.get(q):0}}for(var r=0,m=0;m<b.length;m++)r+=b[m].totalCount;for(var s=new Array(r),t=0,m=0;d>m;m++)for(var j=0;j<b.length;j++)m<g[j].length&&(s[t++]=g[j][m]);for(var m=0;e>m;m++)for(var j=0;j<b.length;j++)m<h[j].length&&(s[t++]=h[j][m]);return s};for(var c={MODE_NUMBER:1,MODE_ALPHA_NUM:2,MODE_8BIT_BYTE:4,MODE_KANJI:8},d={L:1,M:0,Q:3,H:2},e={PATTERN000:0,PATTERN001:1,PATTERN010:2,PATTERN011:3,PATTERN100:4,PATTERN101:5,PATTERN110:6,PATTERN111:7},f={PATTERN_POSITION_TABLE:[[],[6,18],[6,22],[6,26],[6,30],[6,34],[6,22,38],[6,24,42],[6,26,46],[6,28,50],[6,30,54],[6,32,58],[6,34,62],[6,26,46,66],[6,26,48,70],[6,26,50,74],[6,30,54,78],[6,30,56,82],[6,30,58,86],[6,34,62,90],[6,28,50,72,94],[6,26,50,74,98],[6,30,54,78,102],[6,28,54,80,106],[6,32,58,84,110],[6,30,58,86,114],[6,34,62,90,118],[6,26,50,74,98,122],[6,30,54,78,102,126],[6,26,52,78,104,130],[6,30,56,82,108,134],[6,34,60,86,112,138],[6,30,58,86,114,142],[6,34,62,90,118,146],[6,30,54,78,102,126,150],[6,24,50,76,102,128,154],[6,28,54,80,106,132,158],[6,32,58,84,110,136,162],[6,26,54,82,110,138,166],[6,30,58,86,114,142,170]],G15:1335,G18:7973,G15_MASK:21522,getBCHTypeInfo:function(a){for(var b=a<<10;f.getBCHDigit(b)-f.getBCHDigit(f.G15)>=0;)b^=f.G15<<f.getBCHDigit(b)-f.getBCHDigit(f.G15);return(a<<10|b)^f.G15_MASK},getBCHTypeNumber:function(a){for(var b=a<<12;f.getBCHDigit(b)-f.getBCHDigit(f.G18)>=0;)b^=f.G18<<f.getBCHDigit(b)-f.getBCHDigit(f.G18);return a<<12|b},getBCHDigit:function(a){for(var b=0;0!=a;)b++,a>>>=1;return b},getPatternPosition:function(a){return f.PATTERN_POSITION_TABLE[a-1]},getMask:function(a,b,c){switch(a){case e.PATTERN000:return 0==(b+c)%2;case e.PATTERN001:return 0==b%2;case e.PATTERN010:return 0==c%3;case e.PATTERN011:return 0==(b+c)%3;case e.PATTERN100:return 0==(Math.floor(b/2)+Math.floor(c/3))%2;case e.PATTERN101:return 0==b*c%2+b*c%3;case e.PATTERN110:return 0==(b*c%2+b*c%3)%2;case e.PATTERN111:return 0==(b*c%3+(b+c)%2)%2;default:throw new Error("bad maskPattern:"+a)}},getErrorCorrectPolynomial:function(a){for(var b=new i([1],0),c=0;a>c;c++)b=b.multiply(new i([1,g.gexp(c)],0));return b},getLengthInBits:function(a,b){if(b>=1&&10>b)switch(a){case c.MODE_NUMBER:return 10;case c.MODE_ALPHA_NUM:return 9;case c.MODE_8BIT_BYTE:return 8;case c.MODE_KANJI:return 8;default:throw new Error("mode:"+a)}else if(27>b)switch(a){case c.MODE_NUMBER:return 12;case c.MODE_ALPHA_NUM:return 11;case c.MODE_8BIT_BYTE:return 16;case c.MODE_KANJI:return 10;default:throw new Error("mode:"+a)}else{if(!(41>b))throw new Error("type:"+b);switch(a){case c.MODE_NUMBER:return 14;case c.MODE_ALPHA_NUM:return 13;case c.MODE_8BIT_BYTE:return 16;case c.MODE_KANJI:return 12;default:throw new Error("mode:"+a)}}},getLostPoint:function(a){for(var b=a.getModuleCount(),c=0,d=0;b>d;d++)for(var e=0;b>e;e++){for(var f=0,g=a.isDark(d,e),h=-1;1>=h;h++)if(!(0>d+h||d+h>=b))for(var i=-1;1>=i;i++)0>e+i||e+i>=b||(0!=h||0!=i)&&g==a.isDark(d+h,e+i)&&f++;f>5&&(c+=3+f-5)}for(var d=0;b-1>d;d++)for(var e=0;b-1>e;e++){var j=0;a.isDark(d,e)&&j++,a.isDark(d+1,e)&&j++,a.isDark(d,e+1)&&j++,a.isDark(d+1,e+1)&&j++,(0==j||4==j)&&(c+=3)}for(var d=0;b>d;d++)for(var e=0;b-6>e;e++)a.isDark(d,e)&&!a.isDark(d,e+1)&&a.isDark(d,e+2)&&a.isDark(d,e+3)&&a.isDark(d,e+4)&&!a.isDark(d,e+5)&&a.isDark(d,e+6)&&(c+=40);for(var e=0;b>e;e++)for(var d=0;b-6>d;d++)a.isDark(d,e)&&!a.isDark(d+1,e)&&a.isDark(d+2,e)&&a.isDark(d+3,e)&&a.isDark(d+4,e)&&!a.isDark(d+5,e)&&a.isDark(d+6,e)&&(c+=40);for(var k=0,e=0;b>e;e++)for(var d=0;b>d;d++)a.isDark(d,e)&&k++;var l=Math.abs(100*k/b/b-50)/5;return c+=10*l}},g={glog:function(a){if(1>a)throw new Error("glog("+a+")");return g.LOG_TABLE[a]},gexp:function(a){for(;0>a;)a+=255;for(;a>=256;)a-=255;return g.EXP_TABLE[a]},EXP_TABLE:new Array(256),LOG_TABLE:new Array(256)},h=0;8>h;h++)g.EXP_TABLE[h]=1<<h;for(var h=8;256>h;h++)g.EXP_TABLE[h]=g.EXP_TABLE[h-4]^g.EXP_TABLE[h-5]^g.EXP_TABLE[h-6]^g.EXP_TABLE[h-8];for(var h=0;255>h;h++)g.LOG_TABLE[g.EXP_TABLE[h]]=h;i.prototype={get:function(a){return this.num[a]},getLength:function(){return this.num.length},multiply:function(a){for(var b=new Array(this.getLength()+a.getLength()-1),c=0;c<this.getLength();c++)for(var d=0;d<a.getLength();d++)b[c+d]^=g.gexp(g.glog(this.get(c))+g.glog(a.get(d)));return new i(b,0)},mod:function(a){if(this.getLength()-a.getLength()<0)return this;for(var b=g.glog(this.get(0))-g.glog(a.get(0)),c=new Array(this.getLength()),d=0;d<this.getLength();d++)c[d]=this.get(d);for(var d=0;d<a.getLength();d++)c[d]^=g.gexp(g.glog(a.get(d))+b);return new i(c,0).mod(a)}},j.RS_BLOCK_TABLE=[[1,26,19],[1,26,16],[1,26,13],[1,26,9],[1,44,34],[1,44,28],[1,44,22],[1,44,16],[1,70,55],[1,70,44],[2,35,17],[2,35,13],[1,100,80],[2,50,32],[2,50,24],[4,25,9],[1,134,108],[2,67,43],[2,33,15,2,34,16],[2,33,11,2,34,12],[2,86,68],[4,43,27],[4,43,19],[4,43,15],[2,98,78],[4,49,31],[2,32,14,4,33,15],[4,39,13,1,40,14],[2,121,97],[2,60,38,2,61,39],[4,40,18,2,41,19],[4,40,14,2,41,15],[2,146,116],[3,58,36,2,59,37],[4,36,16,4,37,17],[4,36,12,4,37,13],[2,86,68,2,87,69],[4,69,43,1,70,44],[6,43,19,2,44,20],[6,43,15,2,44,16],[4,101,81],[1,80,50,4,81,51],[4,50,22,4,51,23],[3,36,12,8,37,13],[2,116,92,2,117,93],[6,58,36,2,59,37],[4,46,20,6,47,21],[7,42,14,4,43,15],[4,133,107],[8,59,37,1,60,38],[8,44,20,4,45,21],[12,33,11,4,34,12],[3,145,115,1,146,116],[4,64,40,5,65,41],[11,36,16,5,37,17],[11,36,12,5,37,13],[5,109,87,1,110,88],[5,65,41,5,66,42],[5,54,24,7,55,25],[11,36,12],[5,122,98,1,123,99],[7,73,45,3,74,46],[15,43,19,2,44,20],[3,45,15,13,46,16],[1,135,107,5,136,108],[10,74,46,1,75,47],[1,50,22,15,51,23],[2,42,14,17,43,15],[5,150,120,1,151,121],[9,69,43,4,70,44],[17,50,22,1,51,23],[2,42,14,19,43,15],[3,141,113,4,142,114],[3,70,44,11,71,45],[17,47,21,4,48,22],[9,39,13,16,40,14],[3,135,107,5,136,108],[3,67,41,13,68,42],[15,54,24,5,55,25],[15,43,15,10,44,16],[4,144,116,4,145,117],[17,68,42],[17,50,22,6,51,23],[19,46,16,6,47,17],[2,139,111,7,140,112],[17,74,46],[7,54,24,16,55,25],[34,37,13],[4,151,121,5,152,122],[4,75,47,14,76,48],[11,54,24,14,55,25],[16,45,15,14,46,16],[6,147,117,4,148,118],[6,73,45,14,74,46],[11,54,24,16,55,25],[30,46,16,2,47,17],[8,132,106,4,133,107],[8,75,47,13,76,48],[7,54,24,22,55,25],[22,45,15,13,46,16],[10,142,114,2,143,115],[19,74,46,4,75,47],[28,50,22,6,51,23],[33,46,16,4,47,17],[8,152,122,4,153,123],[22,73,45,3,74,46],[8,53,23,26,54,24],[12,45,15,28,46,16],[3,147,117,10,148,118],[3,73,45,23,74,46],[4,54,24,31,55,25],[11,45,15,31,46,16],[7,146,116,7,147,117],[21,73,45,7,74,46],[1,53,23,37,54,24],[19,45,15,26,46,16],[5,145,115,10,146,116],[19,75,47,10,76,48],[15,54,24,25,55,25],[23,45,15,25,46,16],[13,145,115,3,146,116],[2,74,46,29,75,47],[42,54,24,1,55,25],[23,45,15,28,46,16],[17,145,115],[10,74,46,23,75,47],[10,54,24,35,55,25],[19,45,15,35,46,16],[17,145,115,1,146,116],[14,74,46,21,75,47],[29,54,24,19,55,25],[11,45,15,46,46,16],[13,145,115,6,146,116],[14,74,46,23,75,47],[44,54,24,7,55,25],[59,46,16,1,47,17],[12,151,121,7,152,122],[12,75,47,26,76,48],[39,54,24,14,55,25],[22,45,15,41,46,16],[6,151,121,14,152,122],[6,75,47,34,76,48],[46,54,24,10,55,25],[2,45,15,64,46,16],[17,152,122,4,153,123],[29,74,46,14,75,47],[49,54,24,10,55,25],[24,45,15,46,46,16],[4,152,122,18,153,123],[13,74,46,32,75,47],[48,54,24,14,55,25],[42,45,15,32,46,16],[20,147,117,4,148,118],[40,75,47,7,76,48],[43,54,24,22,55,25],[10,45,15,67,46,16],[19,148,118,6,149,119],[18,75,47,31,76,48],[34,54,24,34,55,25],[20,45,15,61,46,16]],j.getRSBlocks=function(a,b){var c=j.getRsBlockTable(a,b);if(void 0==c)throw new Error("bad rs block @ typeNumber:"+a+"/errorCorrectLevel:"+b);for(var d=c.length/3,e=[],f=0;d>f;f++)for(var g=c[3*f+0],h=c[3*f+1],i=c[3*f+2],k=0;g>k;k++)e.push(new j(h,i));return e},j.getRsBlockTable=function(a,b){switch(b){case d.L:return j.RS_BLOCK_TABLE[4*(a-1)+0];case d.M:return j.RS_BLOCK_TABLE[4*(a-1)+1];case d.Q:return j.RS_BLOCK_TABLE[4*(a-1)+2];case d.H:return j.RS_BLOCK_TABLE[4*(a-1)+3];default:return void 0}},k.prototype={get:function(a){var b=Math.floor(a/8);return 1==(1&this.buffer[b]>>>7-a%8)},put:function(a,b){for(var c=0;b>c;c++)this.putBit(1==(1&a>>>b-c-1))},getLengthInBits:function(){return this.length},putBit:function(a){var b=Math.floor(this.length/8);this.buffer.length<=b&&this.buffer.push(0),a&&(this.buffer[b]|=128>>>this.length%8),this.length++}};var l=[[17,14,11,7],[32,26,20,14],[53,42,32,24],[78,62,46,34],[106,84,60,44],[134,106,74,58],[154,122,86,64],[192,152,108,84],[230,180,130,98],[271,213,151,119],[321,251,177,137],[367,287,203,155],[425,331,241,177],[458,362,258,194],[520,412,292,220],[586,450,322,250],[644,504,364,280],[718,560,394,310],[792,624,442,338],[858,666,482,382],[929,711,509,403],[1003,779,565,439],[1091,857,611,461],[1171,911,661,511],[1273,997,715,535],[1367,1059,751,593],[1465,1125,805,625],[1528,1190,868,658],[1628,1264,908,698],[1732,1370,982,742],[1840,1452,1030,790],[1952,1538,1112,842],[2068,1628,1168,898],[2188,1722,1228,958],[2303,1809,1283,983],[2431,1911,1351,1051],[2563,1989,1423,1093],[2699,2099,1499,1139],[2809,2213,1579,1219],[2953,2331,1663,1273]],o=function(){var a=function(a,b){this._el=a,this._htOption=b};return a.prototype.draw=function(a){function g(a,b){var c=document.createElementNS("http://www.w3.org/2000/svg",a);for(var d in b)b.hasOwnProperty(d)&&c.setAttribute(d,b[d]);return c}var b=this._htOption,c=this._el,d=a.getModuleCount();Math.floor(b.width/d),Math.floor(b.height/d),this.clear();var h=g("svg",{viewBox:"0 0 "+String(d)+" "+String(d),width:"100%",height:"100%",fill:b.colorLight});h.setAttributeNS("http://www.w3.org/2000/xmlns/","xmlns:xlink","http://www.w3.org/1999/xlink"),c.appendChild(h),h.appendChild(g("rect",{fill:b.colorDark,width:"1",height:"1",id:"template"}));for(var i=0;d>i;i++)for(var j=0;d>j;j++)if(a.isDark(i,j)){var k=g("use",{x:String(i),y:String(j)});k.setAttributeNS("http://www.w3.org/1999/xlink","href","#template"),h.appendChild(k)}},a.prototype.clear=function(){for(;this._el.hasChildNodes();)this._el.removeChild(this._el.lastChild)},a}(),p="svg"===document.documentElement.tagName.toLowerCase(),q=p?o:m()?function(){function a(){this._elImage.src=this._elCanvas.toDataURL("image/png"),this._elImage.style.display="block",this._elCanvas.style.display="none"}function d(a,b){var c=this;if(c._fFail=b,c._fSuccess=a,null===c._bSupportDataURI){var d=document.createElement("img"),e=function(){c._bSupportDataURI=!1,c._fFail&&_fFail.call(c)},f=function(){c._bSupportDataURI=!0,c._fSuccess&&c._fSuccess.call(c)};return d.onabort=e,d.onerror=e,d.onload=f,d.src="data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4//8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU5ErkJggg==",void 0}c._bSupportDataURI===!0&&c._fSuccess?c._fSuccess.call(c):c._bSupportDataURI===!1&&c._fFail&&c._fFail.call(c)}if(this._android&&this._android<=2.1){var b=1/window.devicePixelRatio,c=CanvasRenderingContext2D.prototype.drawImage;CanvasRenderingContext2D.prototype.drawImage=function(a,d,e,f,g,h,i,j){if("nodeName"in a&&/img/i.test(a.nodeName))for(var l=arguments.length-1;l>=1;l--)arguments[l]=arguments[l]*b;else"undefined"==typeof j&&(arguments[1]*=b,arguments[2]*=b,arguments[3]*=b,arguments[4]*=b);c.apply(this,arguments)}}var e=function(a,b){this._bIsPainted=!1,this._android=n(),this._htOption=b,this._elCanvas=document.createElement("canvas"),this._elCanvas.width=b.width,this._elCanvas.height=b.height,a.appendChild(this._elCanvas),this._el=a,this._oContext=this._elCanvas.getContext("2d"),this._bIsPainted=!1,this._elImage=document.createElement("img"),this._elImage.style.display="none",this._el.appendChild(this._elImage),this._bSupportDataURI=null};return e.prototype.draw=function(a){var b=this._elImage,c=this._oContext,d=this._htOption,e=a.getModuleCount(),f=d.width/e,g=d.height/e,h=Math.round(f),i=Math.round(g);b.style.display="none",this.clear();for(var j=0;e>j;j++)for(var k=0;e>k;k++){var l=a.isDark(j,k),m=k*f,n=j*g;c.strokeStyle=l?d.colorDark:d.colorLight,c.lineWidth=1,c.fillStyle=l?d.colorDark:d.colorLight,c.fillRect(m,n,f,g),c.strokeRect(Math.floor(m)+.5,Math.floor(n)+.5,h,i),c.strokeRect(Math.ceil(m)-.5,Math.ceil(n)-.5,h,i)}this._bIsPainted=!0},e.prototype.makeImage=function(){this._bIsPainted&&d.call(this,a)},e.prototype.isPainted=function(){return this._bIsPainted},e.prototype.clear=function(){this._oContext.clearRect(0,0,this._elCanvas.width,this._elCanvas.height),this._bIsPainted=!1},e.prototype.round=function(a){return a?Math.floor(1e3*a)/1e3:a},e}():function(){var a=function(a,b){this._el=a,this._htOption=b};return a.prototype.draw=function(a){for(var b=this._htOption,c=this._el,d=a.getModuleCount(),e=Math.floor(b.width/d),f=Math.floor(b.height/d),g=['<table style="border:0;border-collapse:collapse;">'],h=0;d>h;h++){g.push("<tr>");for(var i=0;d>i;i++)g.push('<td style="border:0;border-collapse:collapse;padding:0;margin:0;width:'+e+"px;height:"+f+"px;background-color:"+(a.isDark(h,i)?b.colorDark:b.colorLight)+';"></td>');g.push("</tr>")}g.push("</table>"),c.innerHTML=g.join("");var j=c.childNodes[0],k=(b.width-j.offsetWidth)/2,l=(b.height-j.offsetHeight)/2;k>0&&l>0&&(j.style.margin=l+"px "+k+"px")},a.prototype.clear=function(){this._el.innerHTML=""},a}();QRCode=function(a,b){if(this._htOption={width:256,height:256,typeNumber:4,colorDark:"#000000",colorLight:"#ffffff",correctLevel:d.H},"string"==typeof b&&(b={text:b}),b)for(var c in b)this._htOption[c]=b[c];"string"==typeof a&&(a=document.getElementById(a)),this._android=n(),this._el=a,this._oQRCode=null,this._oDrawing=new q(this._el,this._htOption),this._htOption.text&&this.makeCode(this._htOption.text)},QRCode.prototype.makeCode=function(a){this._oQRCode=new b(r(a,this._htOption.correctLevel),this._htOption.correctLevel),this._oQRCode.addData(a),this._oQRCode.make(),this._el.title=a,this._oDrawing.draw(this._oQRCode),this.makeImage()},QRCode.prototype.makeImage=function(){"function"==typeof this._oDrawing.makeImage&&(!this._android||this._android>=3)&&this._oDrawing.makeImage()},QRCode.prototype.clear=function(){this._oDrawing.clear()},QRCode.CorrectLevel=d}();]]>
				</script>
				<style type="text/css">
					body {
					    background-color: #FFFFFF;
					    font-family: 'Tahoma', "Times New Roman", Times, serif;
					    font-size: 11px;
					    color: #666666;
					}
					h1, h2 {
					    padding-bottom: 3px;
					    padding-top: 3px;
					    margin-bottom: 5px;
					    text-transform: uppercase;
					    font-family: Arial, Helvetica, sans-serif;
					}
					h1 {
					    font-size: 1.4em;
					    text-transform:none;
					}
					h2 {
					    font-size: 1em;
					    color: brown;
					}
					h3 {
					    font-size: 1em;
					    color: #333333;
					    text-align: justify;
					    margin: 0;
					    padding: 0;
					}
					h4 {
					    font-size: 1.1em;
					    font-style: bold;
					    font-family: Arial, Helvetica, sans-serif;
					    color: #000000;
					    margin: 0;
					    padding: 0;
					}
					hr {
					    height:2px;
					    color: #000000;
					    background-color: #000000;
					    border-bottom: 1px solid #000000;
					}
					p, ul, ol {
					    margin-top: 1.5em;
					}
					ul, ol {
					    margin-left: 3em;
					}
					blockquote {
					    margin-left: 3em;
					    margin-right: 3em;
					    font-style: italic;
					}
					a {
					    text-decoration: none;
					    color: #70A300;
					}
					a:hover {
					    border: none;
					    color: #70A300;
					}
					#despatchTable {
					    border-collapse:collapse;
					    font-size:11px;
					    float:right;
					    border-color:gray;
					}
					#ettnTable {
					    border-collapse:collapse;
					    font-size:11px;
					    border-color:gray;
					}
					#customerPartyTable {
					    border-width: 0px;
					    border-spacing:;
					    border-style: inset;
					    border-color: gray;
					    border-collapse: collapse;
					    background-color:
					}
					#customerIDTable {
					    border-width: 2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: gray;
					    border-collapse: collapse;
					    background-color:
					}
					#customerIDTableTd {
					    border-width: 2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: gray;
					    border-collapse: collapse;
					    background-color:
					}
					#lineTable {
					    border-width:2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color:;
					}
					td.lineTableTd {
					    border-width: 1px;
					    padding: 1px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					}
					tr.lineTableTr {
					    border-width: 1px;
					    padding: 0px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					    -moz-border-radius:;
					}
					#lineTableDummyTd {
					    border-width: 1px;
					    border-color:white;
					    padding: 1px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					}
					td.lineTableBudgetTd {
					    border-width: 2px;
					    border-spacing:0px;
					    padding: 1px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					    -moz-border-radius:;
					}
					#notesTable {
					    border-width: 2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color:
					}
					#notesTableTd {
					    border-width: 0px;
					    border-spacing:;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color: ;
						vertical-align: top;
					}
					table {
					    border-spacing:0px;
					}
					#budgetContainerTable {
					    border-width: 0px;
					    border-spacing: 0px;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color:;
					}
					td {
					    border-color:gray;
					}</style>
				<title>e-İrsaliye</title>
			</head>
			<body
				style="margin-left=0.6in; margin-right=0.6in; margin-top=0.79in; margin-bottom=0.79in">
				<xsl:for-each select="$XML">
					<table style="border-color:blue; " border="0" cellspacing="0px" width="800"
						cellpadding="0px">
						<tbody>
							<tr valign="top">
								<td width="40%">
									<br/>
									<hr/>
									<table align="center" border="0" width="100%">
										<tbody>
											<tr align="left">
												<xsl:for-each select="n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party">
													<td align="left">
														<xsl:if test="cac:PartyName">
															<xsl:value-of select="cac:PartyName/cbc:Name"/>
															<br/>
														</xsl:if>
													</td>
												</xsl:for-each>
											</tr>
											<tr align="left">
												<xsl:for-each select="n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party">
													<td align="left">
														<xsl:for-each select="cac:PostalAddress">
															<xsl:for-each select="cbc:StreetName">
																<xsl:apply-templates/>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
															<xsl:for-each select="cbc:BuildingName">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:if test="cbc:BuildingNumber">
																<xsl:text> No:</xsl:text>
																<xsl:for-each select="cbc:BuildingNumber">
																	<xsl:apply-templates/>
																</xsl:for-each>
																<xsl:text>&#160;</xsl:text>
															</xsl:if>
															<br/>
															<xsl:for-each select="cbc:PostalZone">
																<xsl:apply-templates/>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
															<xsl:for-each select="cbc:CitySubdivisionName">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:text>/ </xsl:text>
															<xsl:for-each select="cbc:CityName">
																<xsl:apply-templates/>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
														</xsl:for-each>
													</td>
												</xsl:for-each>
											</tr>
											<xsl:if
												test="//n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party/cac:Contact/cbc:Telephone or //n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party/cac:Contact/cbc:Telefax">
												<tr align="left">
													<xsl:for-each select="n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party">														
														<td align="left">
															<xsl:for-each select="cac:Contact">
																<xsl:if test="cbc:Telephone">
																	<xsl:text>Tel: </xsl:text>
																	<xsl:for-each select="cbc:Telephone">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																</xsl:if>
																<xsl:if test="cbc:Telefax">
																	<xsl:text> Fax: </xsl:text>
																	<xsl:for-each select="cbc:Telefax">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																</xsl:if>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
														</td>
													</xsl:for-each>
												</tr>
											</xsl:if>
											<xsl:for-each
												select="//n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party/cbc:WebsiteURI">
												<tr align="left">
													<td>
														<xsl:text>Web Sitesi: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:for-each>
											<xsl:for-each
												select="//n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party/cac:Contact/cbc:ElectronicMail">
												<tr align="left">
													<td>
														<xsl:text>E-Posta: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:for-each>
											<tr align="left">
												<xsl:for-each select="n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party">																											
													<td align="left">
														<xsl:text>Vergi Dairesi: </xsl:text>
														<xsl:for-each select="cac:PartyTaxScheme">
															<xsl:for-each select="cac:TaxScheme">
																<xsl:for-each select="cbc:Name">
																	<xsl:apply-templates/>
																</xsl:for-each>
															</xsl:for-each>
															<xsl:text>&#160; </xsl:text>
														</xsl:for-each>
													</td>
												</xsl:for-each>
											</tr>
											<xsl:for-each
												select="//n1:DespatchAdvice/cac:DespatchSupplierParty/cac:Party/cac:PartyIdentification">
												<tr align="left">
													<td>
														<xsl:value-of select="cbc:ID/@schemeID"/>
														<xsl:text>: </xsl:text>
														<xsl:value-of select="cbc:ID"/>
													</td>
												</tr>
											</xsl:for-each>
										</tbody>
									</table>
									<hr/>
								</td>
								<td width="20%" align="center" valign="middle">
									<br/>
									<br/>
									<img style="width:91px;" align="middle" alt="E-Fatura Logo"
										src="data:image/jpeg;base64,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"/>
									<h1 align="center">
										<span style="font-weight:bold; ">
											<xsl:text>e-İRSALİYE</xsl:text>
										</span>
									</h1>
									<div class="imgBox" valign="middle" >
										<img style="width:140px;height:110px;" align="middle" alt="Imza Logo" src="data:image/jpeg;base64,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"/><br/>
									</div>
								</td>
								<td width="300" align="center" valign="middle">
									<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,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"/><br/>
								</td>
								<td width="40%"/>
								<td width="20%">
									<div id="qrcode" style="width:1px; height:1px;"/>
									<div id="qrvalue" style="visibility: hidden">
										<xsl:value-of select="n1:DespatchAdvice/cbc:UUID"/>
									</div>
									<script type="text/javascript">
										var qrcode = new QRCode(document.getElementById("qrcode"), {
											width : 100,
											height : 100
										});
										function makeCode (msg) {		
											var elText = document.getElementById("text");
											qrcode.makeCode(msg);
										}
										makeCode(document.getElementById("qrvalue").innerHTML);
									</script>
								</td>
							</tr>
							<tr style="height:118px; " valign="top">
								<td width="40%" align="right" valign="bottom">
									<table id="customerPartyTable" align="left" border="0">
										<tbody>
											<tr style="height:71px; ">
												<td>
													<hr/>
													<table align="center" border="0">
														<tbody>
															<tr>
																<xsl:for-each select="n1:DespatchAdvice/cac:DeliveryCustomerParty/cac:Party">
																	<td style="width:469px; " align="left">
																		<span style="font-weight:bold; ">
																			<xsl:text>SAYIN</xsl:text>
																		</span>
																	</td>
																</xsl:for-each>													
															</tr>
															<tr>
																<xsl:choose>
																	<xsl:when test="n1:DespatchAdvice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																		<xsl:for-each select="n1:DespatchAdvice/cac:BuyerCustomerParty/cac:Party">
																			<xsl:call-template name="Party_Title">
																				<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																			</xsl:call-template>
																		</xsl:for-each>															
																	</xsl:when>
																	<xsl:otherwise>
																		<xsl:for-each select="n1:DespatchAdvice/cac:DeliveryCustomerParty/cac:Party">
																			<xsl:call-template name="Party_Title">
																				<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																			</xsl:call-template>
																		</xsl:for-each>															
																	</xsl:otherwise>
																</xsl:choose>													
															</tr>
															<xsl:choose>
																<xsl:when test="n1:DespatchAdvice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																	<xsl:for-each select="n1:DespatchAdvice/cac:BuyerCustomerParty/cac:Party">
																		<tr>
																			<xsl:call-template name="Party_Adress">
																				<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																			</xsl:call-template>
																		</tr>
																		<xsl:call-template name="Party_Other">
																			<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>															
																</xsl:when>
																<xsl:otherwise>
																	<xsl:for-each select="n1:DespatchAdvice/cac:DeliveryCustomerParty/cac:Party">
																		<tr>
																			<xsl:call-template name="Party_Adress">
																				<xsl:with-param name="PartyType">OTHER</xsl:with-param>																	
																			</xsl:call-template>
																		</tr>
																		<xsl:call-template name="Party_Other">
																			<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:otherwise>
															</xsl:choose>																										
														</tbody>
													</table>
													<hr/>
												</td>
											</tr>
										</tbody>
									</table>
									<br/>
								</td>
								<td width="60%" align="center" valign="bottom" colspan="2">
									<table border="1" id="despatchTable">
										<tbody>
											<tr>
												<td style="width:105px;" align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Özelleştirme No:</xsl:text>
													</span>
												</td>
												<td style="width:110px;" align="left">
													<xsl:for-each select="n1:DespatchAdvice/cbc:CustomizationID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Senaryo:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:DespatchAdvice/cbc:ProfileID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye Tipi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:DespatchAdvice/cbc:DespatchAdviceTypeCode">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye No:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:DespatchAdvice/cbc:ID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye Tarihi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:DespatchAdvice/cbc:IssueDate">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:DespatchAdvice/cbc:IssueTime">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sevk Tarihi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:DespatchAdvice/cac:Shipment/cac:Delivery/cac:Despatch/cbc:ActualDespatchDate">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sevk Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:DespatchAdvice/cac:Shipment/cac:Delivery/cac:Despatch/cbc:ActualDespatchTime">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<xsl:if test="n1:DespatchAdvice/cac:OrderReference">
												<tr style="height:13px">
													<td align="left">
														<span style="font-weight:bold; ">
															<xsl:text>Sipariş No:</xsl:text>
														</span>
													</td>
													<td align="left">
														<xsl:for-each select="n1:DespatchAdvice/cac:OrderReference/cbc:ID">
															<xsl:apply-templates/>
														</xsl:for-each>
													</td>
												</tr>
											</xsl:if>
											<xsl:if	test="n1:DespatchAdvice/cac:OrderReference/cbc:IssueDate">
												<tr style="height:13px">
													<td align="left">
														<span style="font-weight:bold; ">
															<xsl:text>Sipariş Tarihi:</xsl:text>
														</span>
													</td>
													<td align="left">
														<xsl:for-each select="n1:DespatchAdvice/cac:OrderReference/cbc:IssueDate">
															<xsl:apply-templates select="."/>
														</xsl:for-each>
													</td>
												</tr>
											</xsl:if>
										</tbody>
									</table>
								</td>
							</tr>
							<xsl:if test="n1:DespatchAdvice/cac:Shipment/cac:Delivery/cac:DeliveryAddress">
								<tr align="left">
									<table>
										<tr>
											<td style="width:469px; " align="left">
												<span style="font-weight:bold;">
													<xsl:text>Teslimat Adresi</xsl:text>
												</span>
											</td>
										</tr>
										<tr>
											<xsl:for-each select="n1:DespatchAdvice/cac:Shipment/cac:Delivery">
												<td align="left">
													<xsl:for-each select="cac:DeliveryAddress">
														<xsl:for-each select="cbc:StreetName">
															<xsl:apply-templates/>
															<xsl:text>&#160;</xsl:text>
														</xsl:for-each>
														<xsl:for-each select="cbc:BuildingName">
															<xsl:apply-templates/>
														</xsl:for-each>
														<xsl:if test="cbc:BuildingNumber">
															<xsl:text> No:</xsl:text>
															<xsl:for-each select="cbc:BuildingNumber">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:text>&#160;</xsl:text>
														</xsl:if>
														<br/>
														<xsl:for-each select="cbc:PostalZone">
															<xsl:apply-templates/>
															<xsl:text>&#160;</xsl:text>
														</xsl:for-each>
														<xsl:for-each select="cbc:CitySubdivisionName">
															<xsl:apply-templates/>
														</xsl:for-each>
														<xsl:text>/ </xsl:text>
														<xsl:for-each select="cbc:CityName">
															<xsl:apply-templates/>
															<xsl:text>&#160;</xsl:text>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</xsl:for-each>
										</tr>
									</table>
								</tr>
							</xsl:if>
							<br/>
							<tr align="left">
								<td align="left" valign="top" id="ettnTable">
									<span style="font-weight:bold; ">
										<xsl:text>ETTN:&#160;</xsl:text>
									</span>
									<xsl:for-each select="n1:DespatchAdvice/cbc:UUID">
										<xsl:apply-templates/>
									</xsl:for-each>
								</td>
							</tr>
						</tbody>
					</table>
					<div id="lineTableAligner">
						<span>
							<xsl:text>&#160;</xsl:text>
						</span>
					</div>
					<table border="1" id="lineTable" width="800">
						<tbody>
							<tr class="lineTableTr">
								<td class="lineTableTd" style="width:5%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Sıra No</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Stok Kodu</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:30%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Mal</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Miktar</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Birim Fiyat</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:20%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Sonra Gönderilecek Miktar</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:15%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Tutar</xsl:text>
									</span>
								</td>
							</tr>
							<xsl:for-each select="//n1:DespatchAdvice/cac:DespatchLine">
								<xsl:apply-templates select="."/>
							</xsl:for-each>
						</tbody>
					</table>
				</xsl:for-each>
				<table id="budgetContainerTable" width="800px">
					<tr align="right">
						<td/>
						<td class="lineTableBudgetTd" align="right" width="156px">
							<span style="font-weight:bold; ">
								<xsl:text>Toplam Tutar</xsl:text>
							</span>
						</td>
						<td class="lineTableBudgetTd" style="width:156px; " align="right">
							<xsl:for-each select="n1:DespatchAdvice/cac:Shipment/cac:GoodsItem/cbc:ValueAmount">
								<xsl:call-template name="Curr_Type"/>
							</xsl:for-each>
						</td>
					</tr>
				</table>
				<br/>
				<xsl:if test="//n1:DespatchAdvice/cac:AdditionalDocumentReference">
					<table id="lineTable" width="800">
						<thead>
							<tr>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;İlgili Dokümanlar</span>
								</td>							
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;</span>
								</td>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;</span>
								</td>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;</span>
								</td>
							</tr>
						</thead>					
						<tbody>
							<tr align="left" class="lineTableTr">							
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Doküman No</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Tarih</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Doküman Tipi</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Açıklama</span>
								</td>
							</tr>
							<xsl:for-each select="//n1:DespatchAdvice/cac:AdditionalDocumentReference">
								<tr align="left" class="lineTableTr">
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="./cbc:ID"/> 
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:for-each select="./cbc:IssueDate">
											<xsl:apply-templates select="."/>
										</xsl:for-each> 
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="./cbc:DocumentType"/> 
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="./cbc:DocumentDescription"/> 
									</td>
								</tr>
							</xsl:for-each>
						</tbody>
					</table>
				</xsl:if>
				<br/>
				<table id="notesTable" width="800">
					<thead>
						<tr>
							<td align="left">
								<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Açıklamalar</span>
							</td>
							<td align="left">
								<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Taşıyıcı Bilgileri</span>
							</td>								
						</tr>
					</thead>
					<tbody>
						<tr align="left">
							<td id="notesTableTd" height="100">
								<xsl:for-each select="//n1:DespatchAdvice/cbc:Note">
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Not: </b>
									<xsl:value-of select="."/>	
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:SellerSupplierParty"> 
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Satıcı VKN: </b>
									<xsl:value-of select="cac:Party/cac:PartyIdentification/cbc:ID"/>
									<br/>
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Satıcı Ünvan: </b>
									<xsl:value-of select="cac:Party/cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:for-each>
								<xsl:for-each select="//cac:BuyerCustomerParty"> 
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Alıcı VKN: </b>
									<xsl:value-of select="cac:Party/cac:PartyIdentification/cbc:ID"/>
									<br/>
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Alıcı Ünvan: </b>
									<xsl:value-of select="cac:Party/cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:OriginatorCustomerParty"> 
									<b>&#160;&#160;&#160;&#160;&#160;&#160;İşlemleri Başlatan Alıcı VKN: </b>
									<xsl:value-of select="cac:Party/cac:PartyIdentification/cbc:ID"/>
									<br/>
									<b>&#160;&#160;&#160;&#160;&#160;&#160;İşlemleri Başlatan Alıcı Ünvan: </b>
									<xsl:value-of select="cac:Party/cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:for-each>
								<xsl:for-each select="//cac:DespatchSupplierParty/cac:Party/cac:Person">
									<xsl:if	test="cbc:FirstName">									
										<b>&#160;&#160;&#160;&#160;&#160; Teslim Eden: </b>
										<xsl:for-each select="cbc:Title">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:FirstName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:MiddleName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:FamilyName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:NameSuffix">
											<xsl:apply-templates/>
										</xsl:for-each>
										<br/>
									</xsl:if>
								</xsl:for-each>
							</td>
							<td id="notesTableTd" height="100">
								<xsl:for-each select="//cac:CarrierParty">
									<b>&#160;&#160;&#160;&#160;&#160;&#160; Taşıyıcı Firma: </b>
									VKN: <xsl:value-of select="./cac:PartyIdentification/cbc:ID"/>, <xsl:value-of select="./cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:for-each>
								<xsl:for-each select="//cac:ShipmentStage/cac:TransportMeans/cac:RoadTransport/cbc:LicensePlateID">
									<b>&#160;&#160;&#160;&#160;&#160;&#160; Araç plaka numarası: </b>
									<xsl:value-of select="."/>	
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:TransportHandlingUnit/cac:TransportEquipment/cbc:ID[@schemeID = 'DORSEPLAKA']">
									<b>&#160;&#160;&#160;&#160;&#160;&#160; Dorse plaka numarası: </b>
									<xsl:value-of select="."/>	
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:ShipmentStage/cac:DriverPerson">
									<xsl:if	test="cbc:FirstName">									
										<b>&#160;&#160;&#160;&#160;&#160;&#160; Şoför: </b>
										<xsl:for-each select="cbc:Title">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:FirstName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:MiddleName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:FamilyName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>, TCKN:
										<xsl:for-each select="cbc:NationalityID">
											<xsl:apply-templates/>
										</xsl:for-each>
										<br/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="//n1:DespatchAdvice/cac:DespatchLine">
		<tr class="lineTableTr">
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of select="./cbc:ID"/>
			</td>
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of select="./cac:Item/cac:SellersItemIdentification/cbc:ID"/>
			</td>
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of select="./cac:Item/cbc:Name"/>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cbc:DeliveredQuantity, '###.###,####', 'european')"/>
				<xsl:if test="./cbc:DeliveredQuantity/@unitCode">
					<xsl:for-each select="./cbc:DeliveredQuantity">
						<xsl:text> </xsl:text>
						<xsl:choose>
							<xsl:when test="@unitCode  = 'TNE'">
								<span>
									<xsl:text>Ton</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BX'">
								<span>
									<xsl:text>Kutu</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LTR'">
								<span>
									<xsl:text>LT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'C62'">
								<span>
									<xsl:text>Adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAA'">
								<span>
									<xsl:text>Dekar</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<span>
									<xsl:text>KG</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HAR'">
								<span>
									<xsl:text>Hektar</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KJO'">
								<span>
									<xsl:text>kJ</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<span>
									<xsl:text>G</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<span>
									<xsl:text>MG</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NT'">
								<span>
									<xsl:text>Net Ton</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GT'">
								<span>
									<xsl:text>GT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTR'">
								<span>
									<xsl:text>M</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMT'">
								<span>
									<xsl:text>MM</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KMT'">
								<span>
									<xsl:text>KM</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<span>
									<xsl:text>ML</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMQ'">
								<span>
									<xsl:text>MM3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CLT'">
								<span>
									<xsl:text>CL</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMK'">
								<span>
									<xsl:text>CM2</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMQ'">
								<span>
									<xsl:text>CM3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMT'">
								<span>
									<xsl:text>CM</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTK'">
								<span>
									<xsl:text>M2</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTQ'">
								<span>
									<xsl:text>M3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAY'">
								<span>
									<xsl:text>Gün</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MON'">
								<span>
									<xsl:text>Ay</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<span>
									<xsl:text>Yıl</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<span>
									<xsl:text>Saat</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D61'">
								<span>
									<xsl:text>Dakika</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D62'">
								<span>
									<xsl:text>Saniye</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PA'">
								<span>
									<xsl:text>Paket</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'R9'">
								<span>
									<xsl:text>1000 m3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWH'">
								<span>
									<xsl:text>KWH</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GMS'">
								<span>
									<xsl:text>Gümüs</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CTM'">
								<span>
									<xsl:text>Karat</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<span>
									<xsl:text>Yıl</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<span>
									<xsl:text>Saat</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MIN'">
								<span>
									<xsl:text>Dakika</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SEC'">
								<span>
									<xsl:text>Saniye</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LPA'">
								<span>
									<xsl:text>saf alkol lt</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BG'">
								<span>
									<xsl:text>Torba</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PR'">
								<span>
									<xsl:text>Adet-Çift</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DZN'">
								<span>
									<xsl:text>Düzine</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SET'">
								<span>
									<xsl:text>Set</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NPL'">
								<span>
									<xsl:text>Koli</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'FTK'">
								<span>
									<xsl:text>Ayak kare</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'FOT'">
								<span>
									<xsl:text>Ayak</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'AFF'">
								<span>
									<xsl:text>AFİF birim fiyatı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'AKQ'">
								<span>
									<xsl:text>ATV Birim Fiyatı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'AYR'">
								<span>
									<xsl:text>Altın ayarı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'B32'">
								<span>
									<xsl:text>KG-METRE kare</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BAS'">
								<span>
									<xsl:text>Bas</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CCT'">
								<span>
									<xsl:text>Ton başı taşıma</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D30'">
								<span>
									<xsl:text>Brüt Kalori değeri</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D40'">
								<span>
									<xsl:text>Bin Litre</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CEN'">
								<span>
									<xsl:text>Yüz adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'T3'">
								<span>
									<xsl:text>Bin adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'OTB'">
								<span>
									<xsl:text>OTV birim fiyatı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'OMV'">
								<span>
									<xsl:text>OTV Maktu Vergi</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D97'">
								<span>
									<xsl:text>Palet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<span>
									<xsl:text>Mililitre</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<span>
									<xsl:text>Miligram</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<span>
									<xsl:text>Gram</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<span>
									<xsl:text>Kilogram</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GFI'">
								<span>
									<xsl:text>Fıssıle İzotop Gramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KUR'">
								<span>
									<xsl:text>Uranyum Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KSH'">
								<span>
									<xsl:text>Sodyum Hidroksit Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KSD'">
								<span>
									<xsl:text>%90 Kuru Ürün Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KPR'">
								<span>
									<xsl:text>Kilogram-Çift</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KPH'">
								<span>
									<xsl:text>Kg Potasyum Oksid</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KFO'">
								<span>
									<xsl:text>Difosfor Pentaoksit Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'K62'">
								<span>
									<xsl:text>Kilogram-Adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'K58'">
								<span>
									<xsl:text>Kurutulmuş Net Ağırlıklı Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'K20'">
								<span>
									<xsl:text>Kilogram Potasyum Oksit</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LO'">
								<span>
									<xsl:text>Lot</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KMA'">
								<span>
									<xsl:text>METİL AMİNLERİN KİLOGRAMI</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KNI'">
								<span>
									<xsl:text>AZOTUN KİLOGRAMI</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D32'">
								<span>
									<xsl:text>TERAWATT SAAT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GWH'">
								<span>
									<xsl:text>GİGAWATT SAAT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MWH'">
								<span>
									<xsl:text>MEGAWATT SAAT </xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWT'">
								<span>
									<xsl:text>KİLOWATT </xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DMK'">
								<span>
									<xsl:text>DESİMETRE KARE</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SM3'">
								<span>
									<xsl:text>STANDART METREKÜP</xsl:text>
								</span>
							</xsl:when>						
						</xsl:choose>
					</xsl:for-each>
				</xsl:if>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cac:Price/cbc:PriceAmount, '###.##0,########', 'european')"/>
				<xsl:if test="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cac:Price/cbc:PriceAmount/@currencyID">
					<xsl:text> </xsl:text>
					<xsl:if test="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cac:Price/cbc:PriceAmount/@currencyID = &quot;TRL&quot; or ./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cac:Price/cbc:PriceAmount/@currencyID = &quot;TRY&quot;">
						<xsl:text>TL</xsl:text>
					</xsl:if>
					<xsl:if test="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cac:Price/cbc:PriceAmount/@currencyID != &quot;TRL&quot; and ./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cac:Price/cbc:PriceAmount/@currencyID != &quot;TRY&quot;">
						<xsl:value-of select="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cac:Price/cbc:PriceAmount/@currencyID"/>
					</xsl:if>
				</xsl:if>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cbc:OutstandingQuantity, '###.###,####', 'european')"/>
				<xsl:if test="./cbc:OutstandingQuantity/@unitCode">
					<xsl:for-each select="./cbc:OutstandingQuantity">
						<xsl:text> </xsl:text>
						<xsl:choose>
							<xsl:when test="@unitCode  = '26'">
								<xsl:text>ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BX'">
								<xsl:text>Kutu</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LTR'">
								<xsl:text>lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'C62'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NIU'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<xsl:text>kg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KJO'">
								<xsl:text>kJ</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<xsl:text>g</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<xsl:text>mg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NT'">
								<xsl:text>Net Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GT'">
								<xsl:text>Gross Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTR'">
								<xsl:text>m</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMT'">
								<xsl:text>mm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KTM'">
								<xsl:text>km</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<xsl:text>ml</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMQ'">
								<xsl:text>mm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CLT'">
								<xsl:text>cl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMK'">
								<xsl:text>cm2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMQ'">
								<xsl:text>cm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMT'">
								<xsl:text>cm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTK'">
								<xsl:text>m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTQ'">
								<xsl:text>m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAY'">
								<xsl:text> Gün</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MON'">
								<xsl:text> Ay</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PA'">
								<xsl:text> Paket</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWH'">
								<xsl:text> KWH</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<xsl:text> Yıl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<xsl:text> Saat</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D61'">
								<xsl:text> Dakika</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D62'">
								<xsl:text> Saniye</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CCT'">
								<xsl:text> Ton baş.taşıma kap.</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D30'">
								<xsl:text> Brüt kalori</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D40'">
								<xsl:text> 1000 lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LPA'">
								<xsl:text> saf alkol lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'B32'">
								<xsl:text> kg.m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NCL'">
								<xsl:text> hücre adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PR'">
								<xsl:text> Çift</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'R9'">
								<xsl:text> 1000 m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SET'">
								<xsl:text> Set</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'T3'">
								<xsl:text> 1000 adet</xsl:text>
							</xsl:when>							
						</xsl:choose>
					</xsl:for-each>
				</xsl:if>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cbc:LineExtensionAmount, '###.##0,########', 'european')"/>
				<xsl:if test="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cbc:LineExtensionAmount/@currencyID">
					<xsl:text> </xsl:text>
					<xsl:if test="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cbc:LineExtensionAmount/@currencyID = &quot;TRL&quot; or ./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cbc:LineExtensionAmount/@currencyID = &quot;TRY&quot;">
						<xsl:text>TL</xsl:text>
					</xsl:if>
					<xsl:if test="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cbc:LineExtensionAmount/@currencyID != &quot;TRL&quot; and ./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cbc:LineExtensionAmount/@currencyID != &quot;TRY&quot;">
						<xsl:value-of select="./cac:Shipment/cac:GoodsItem/cac:InvoiceLine/cbc:LineExtensionAmount/@currencyID"/>
					</xsl:if>
				</xsl:if>
			</td>
		</tr>
	</xsl:template>
	<xsl:template match="//cbc:IssueDate">
		<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
	</xsl:template>
	<xsl:template match="//cbc:ActualDespatchDate">
		<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
	</xsl:template>
	<xsl:template match="//n1:DespatchAdvice">
		<tr class="lineTableTr">
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
		</tr>
	</xsl:template>
	<xsl:template name="Party_Title" >
		<xsl:param name="PartyType" />
		<td style="width:469px; " align="left">
			<xsl:if test="cac:PartyName">
				<xsl:value-of select="cac:PartyName/cbc:Name"/>
				<br/>
			</xsl:if>
			<xsl:for-each select="cac:Person">
				<xsl:for-each select="cbc:Title">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:FirstName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:MiddleName">
					<xsl:apply-templates/>
					<xsl:text>&#160; </xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:FamilyName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:NameSuffix">
					<xsl:apply-templates/>
				</xsl:for-each>
				<xsl:if test="$PartyType='TAXFREE'">
					<br/>
					<xsl:text>Pasaport No: </xsl:text>
					<xsl:value-of select="cac:IdentityDocumentReference/cbc:ID"/>
					<br/>
					<xsl:text>Ülkesi: </xsl:text>
					<xsl:value-of select="cbc:NationalityID"/>	
				</xsl:if>
			</xsl:for-each>
		</td>		
	</xsl:template>
	<xsl:template name="Party_Adress" >
		<xsl:param name="PartyType" />
		<td style="width:469px; " align="left">
			<xsl:for-each select="cac:PostalAddress">
				<xsl:for-each select="cbc:StreetName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:BuildingName">
					<xsl:apply-templates/>
				</xsl:for-each>
				<xsl:for-each select="cbc:BuildingNumber">
					<xsl:text> No:</xsl:text>
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<br/>
				<xsl:for-each select="cbc:Room">
					<xsl:text>Kapı No:</xsl:text>
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<br/>
				<xsl:for-each select="cbc:PostalZone">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:CitySubdivisionName">
					<xsl:apply-templates/>
					<xsl:text>/ </xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:CityName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:if test="$PartyType='TAXFREE'">
					<br/>
					<xsl:value-of select="cac:Country/cbc:Name"/>
					<br/>
				</xsl:if>
			</xsl:for-each>
		</td>
	</xsl:template>
	<xsl:template name='Party_Other'>
		<xsl:param name="PartyType" />
		<xsl:for-each select="cbc:WebsiteURI">
			<tr align="left">
				<td>
					<xsl:text>Web Sitesi: </xsl:text>
					<xsl:value-of select="."/>
				</td>
			</tr>
		</xsl:for-each>
		<xsl:for-each select="cac:Contact/cbc:ElectronicMail">
			<tr align="left">
				<td>
					<xsl:text>E-Posta: </xsl:text>
					<xsl:value-of select="."/>
				</td>
			</tr>
		</xsl:for-each>	
		<xsl:for-each select="cac:Contact">
			<xsl:if test="cbc:Telephone or cbc:Telefax">
				<tr align="left">
					<td style="width:469px; " align="left">
						<xsl:for-each select="cbc:Telephone">
							<xsl:text>Tel: </xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
						<xsl:for-each select="cbc:Telefax">
							<xsl:text> Fax: </xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
						<xsl:text>&#160;</xsl:text>
					</td>
				</tr>
			</xsl:if>
		</xsl:for-each>
		<xsl:if test="$PartyType!='TAXFREE'">
			<xsl:for-each select="cac:PartyTaxScheme/cac:TaxScheme/cbc:Name">
				<tr align="left">
					<td>
						<xsl:text>Vergi Dairesi: </xsl:text>
						<xsl:apply-templates/>
					</td>
				</tr>
			</xsl:for-each>
			<xsl:for-each select="cac:PartyIdentification">
				<tr align="left">
					<td>
						<xsl:value-of select="cbc:ID/@schemeID"/>
						<xsl:text>: </xsl:text>
						<xsl:value-of select="cbc:ID"/>
					</td>
				</tr>
			</xsl:for-each>
		</xsl:if>
	</xsl:template>
	<xsl:template name="Curr_Type">
		<xsl:value-of select="format-number(., '###.##0,00', 'european')"/>		
		<xsl:if	test="@currencyID">
			<xsl:text> </xsl:text>
			<xsl:choose>
				<xsl:when test="@currencyID = 'TRL' or @currencyID = 'TRY'">
					<xsl:text>TL</xsl:text>					
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@currencyID"/>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:if>		
	</xsl:template>
</xsl:stylesheet>