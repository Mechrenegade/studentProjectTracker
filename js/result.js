var $=dojo.byId;dojo.require("dojo.io");
var url=window.location.toString().split("#")[0];
function diffUsingJS(){
    
var base=difflib.stringAsLines($("baseText").value);
var newtxt=difflib.stringAsLines($("newText").value);
var sm=new difflib.SequenceMatcher(base,newtxt);
var opcodes=sm.get_opcodes();
var diffoutputdiv=$("diffoutput");
while(diffoutputdiv.firstChild)diffoutputdiv.removeChild(diffoutputdiv.firstChild);

var contextSize=$("contextSize").value;contextSize=contextSize?contextSize:null;
diffoutputdiv.appendChild(diffview.buildView({
    baseTextLines:base,newTextLines:newtxt,opcodes:opcodes,baseTextName:"Base Text",newTextName:"New Text",contextSize:contextSize,viewType:$("inline").checked?1:0}));
    window.location=url+"#diff";
}

function diffUsingPython(){
    dojo.io.bind({
        url:"/diff/postYieldDiffData",method:"POST",content:{baseText:$("baseText").value,newText:$("newText").value,ignoreWhitespace:"Y"},load:function(type,data,evt){
            try{
                data=eval('('+data+')');
                while(diffoutputdiv.firstChild)diffoutputdiv.removeChild(diffoutputdiv.firstChild);
                $("output").appendChild(diffview.buildView({
                    baseTextLines:data.baseTextLines,newTextLines:data.newTextLines,opcodes:data.opcodes,baseTextName:data.baseTextName,newTextName:data.newTextName,contextSize:contextSize
                    }));
                }catch(ex){
                    alert("An error occurred updating the diff view:\n"+ex.toString());
                }},
                error:function(type,evt){
                    alert('Error occurred getting diff data.  Check the server logs.');
                },type:'text/javascript'
                }
            );
}