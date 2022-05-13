url=self.location.toString();iev=0;
if(typeof document.all!='object'&&typeof XMLHttpRequest!='object'&&typeof XMLHttpRequest!='function'&&url.indexOf('=browser')==-1){window.location='info.php?reason=browser'}

if(typeof document.all=='object'){
iev=navigator.userAgent;iev=iev.split('MSIE');iev=parseInt(iev[1]);if(iev<7){
document.write('<link rel="stylesheet" type="text/css" href="'+skin_dir+'/msie56.css" />');}
document.write('<meta http-equiv="Page-Enter" content="revealtrans(duration=0)"><meta http-equiv="Page-Exit" content="revealtrans(duration=0)">')
document.write('<link rel="stylesheet" type="text/css" href="'+skin_dir+'/msie.css" />');}

flash='<object data="'+skin_dir+'/sound.swf" type="application/x-shockwave-flash" width="1" height="1" style="visibility:hidden"><param name="movie" value="'+skin_dir+'/sound.swf" /><param name="menu" value="false" /><param name="quality" value="high" /></object>';


/* --- */

function setWH(){
if(typeof document.all=='object'&&iev<7){
dh=document.body.clientHeight;if(dh<500){
self.resizeTo(800,screen.availHeight);
self.moveTo(0,0)}}}

/* --- */

function go(w){a=/&amp;/g;w=w.replace(a,'&');window.location=w;return false}
function ad(w){eeL.value=eeL.value+ ' '+w+' ';fc();}
function rn(){r=Math.round(99999999*Math.random());return r}
function fc(){eeL.focus()}
function op(m,n){if(typeof document.all=='object'){m.style.filter='alpha(opacity='+n*10+')';}else{m.style.opacity=n/10;}return false} function q0(){switch(set_midd){case 8:q=5*5+6;break;case 9:q=99999;break;default:q=1;break;}return q;}
function q1(){for(i=0;i<smiles.length;i++){document.writeln(' <a href="info.php?reason=link" onclick="ad(\''+smiles[i]+'\');return false"><img class="e" src="'+skin_dir+'/smilies/'+sfiles[i]+'" alt="'+smiles[i]+'" title="'+smiles[i]+'" onmouseover="return op(this,5)" onmouseout="return op(this,10)" /></a> ')}}
function q2(){for(i=0;i<colors.length;i++){document.writeln('<img class="r" src="incl/trans.png" onclick="set_color(this.style.backgroundColor)" style="background-color:#'+colors[i]+'" alt="" />')}}

/* --- */

function q3(){
for(i=-12;i<0;i++){j=i*-1;
document.write(' <a href="info.php?reason=link" style="text-decoration:none" onclick="set_time('+i+');return false">'+j+'</a> ')}
document.write('- <a href="info.php?reason=link" style="text-decoration:none" onclick="set_time(0);return false">GMT</a> +');
for(i=1;i<13;i++){
document.write(' <a href="info.php?reason=link" style="text-decoration:none" onclick="set_time('+i+');return false">'+i+'</a> ')}}

/* --- */

function check_log(w){
f=document.forms.fms;ok=1;a=f.name;b=f.pass
if(typeof f.turnum=='object'){
c=f.turnum;d=parseInt(c.value);d=d.toString()
if(d.length!=5){c.value='';c.focus();ok=0}}
if(a.value==b.value){a.value='';b.value='';a.focus();ok=0}
if(b.value.length<3){b.value='';b.focus();ok=0}
if(a.value.length<3){a.value='';a.focus();ok=0}
if(ok==1){return true}else{
document.getElementById('emms').innerHTML=w
return false}}

/* --- */

function check_reg(w){
f=document.forms.fms;ok=1;a=f.name
b=f.pass;c=f.cass;g=f.mail
if(typeof f.turnum=='object'){
d=f.turnum;e=parseInt(d.value);e=e.toString()
if(e.length!=5){d.value='';d.focus();ok=0}}
if(g.value.length<7||g.value.indexOf('@')==-1||g.value.indexOf('.')==-1){
g.value='';g.focus();ok=0}
if(b.value.length<3){b.value='';b.focus();ok=0}
if(b.value!=c.value){b.value='';c.value='';b.focus();ok=0}
if(a.value==b.value){b.value='';c.value='';b.focus();ok=0}
if(a.value.length<3){a.value='';a.focus();ok=0}
if(ok==1){return true}else{
document.getElementById('emms').innerHTML=w
return false}}

/* --- */

function check_pro(){
f=document.forms.fms;ok=1;
a=f.oass;b=f.pass;c=f.cass;d=f.mail
if(d.value.length<7||d.value.indexOf('@')==-1||d.value.indexOf('.')==-1){
f.reset();ok=0}
if(a.value.length>0||b.value.length>0||c.value.length>0){
if((b.value!=c.value)||a.value.length<3||b.value.length<3||a.value==b.value){
a.value='';b.value='';c.value='';a.focus();ok=0}}
if(ok==1){return true}else{return false}}

/* --- */

function check_ver(w){
f=document.forms.fms;ok=1;a=f.vcode
if(typeof f.turnum=='object'){
d=f.turnum;e=parseInt(d.value);e=e.toString()
if(e.length!=5){d.value='';d.focus();ok=0}}
if(a.value.length!=8){a.value='';a.focus();ok=0}
if(ok==1){return true}else{
document.getElementById('emms').innerHTML=w
return false}}

/* --- */

function check_fps(w){
f=document.forms.fms;ok=1;g=f.mail
if(typeof f.turnum=='object'){
d=f.turnum;e=parseInt(d.value);e=e.toString()
if(e.length!=5){d.value='';d.focus();ok=0}}
if(g.value.length<7||g.value.indexOf('@')==-1||g.value.indexOf('.')==-1){
g.value='';g.focus();ok=0}
if(ok==1){return true}else{
document.getElementById('emms').innerHTML=w
return false}}

/* --- */

function http_obj(){
if(typeof document.all=='object'){
r=new ActiveXObject("Microsoft.XMLHTTP")}
else{r=new XMLHttpRequest()}return r}

/* --- */

function reset_some(){
eeE.style.display='none'
eeF.style.display='none'
eeG.style.display='none'
eeI.style.display='none'
eeK.style.display='none'}

/* --- */

function reset_all(){
elements();reset_some();
lock1=0;lock2=0;lock3=0;
txt='';ajx_line='';ajx_last=0;ajx_toid=0;ajx_room=0;
eeA.innerHTML='';
eeB.innerHTML='';
document.getElementById('reqt').innerHTML='';
document.getElementById('quer').innerHTML='';
document.getElementById('inpt').style.visibility='hidden'
eeB.style.display='none'
eeC.style.display='none'
eeJ.style.display='none'

if(typeof room_tout=='number'){clearTimeout(room_tout)}
if(typeof chat_tout=='number'){clearTimeout(chat_tout)}
}

/* --- */

function not_connected(){
if(ajx_sndd==1){allow_flash=flash}else{allow_flash=''}
tit='<br /><br />'+set_disc+'<br /><a href="blab.php?r='+r+'"><b>'+set_clck+'</b></a>'+allow_flash;
if(typeof room_tout=='number'){clearTimeout(room_tout)}
if(typeof chat_tout=='number'){clearTimeout(chat_tout)}
eeB.innerHTML=tit}

/* --- */

function connected(){if(sup_errs<1){r=rn();
if(typeof conn_tout=='number'){clearTimeout(conn_tout)}
conn_tout=setTimeout('not_connected()',set_refr*6000)}}

/* --- */

function set_post(){
if(lock1==0){
if(eeL.value.length>0){ajx_line=eeL.value;eeL.value='';
stlB=stlB.toString();stlI=stlI.toString()
stlU=stlU.toString();stlC=stlC.toString()
ajx_lbiu=stlB+stlI+stlU;ajx_lclr=stlC

if(ajx_toid==0){fc()}
if(typeof chat_tout=='number'){clearTimeout(chat_tout)}
chat();}}}

/* --- */

function set_private(){

if(lock1==0){
if(eeM.value.length>0){
mpt=eeL.value;
ajx_toid=tmp;
eeL.value=eeM.value;eeM.value='';eeM.focus()
set_post();eeL.value=mpt;ajx_toid=0}}}

/* --- */

function set_color(w){
eeL.style.color=w;
eeM.style.color=w;
document.getElementById('cl').style.backgroundColor=w;
eeC.style.display='block';
eeE.style.display='none';eeF.style.display='none';
eeI.style.display='none';eeK.style.display='none';
stlC=w;fc()}

/* --- */

function set_time(s){
if(ajx_room>0){
mpt=eeL.value;
s=parseInt(s);ajx_zone=parseInt(ajx_zone)
ajx_toid=ajx_user;
if(s==0){ajx_zone=0;}else{ajx_zone=s;}
eeL.value='GMT ['+ajx_zone+']';
set_post();ajx_toid=0;eeL.value=mpt;
eeI.style.display='none';fc()}}

/* --- */

function set_sound(q,r){
if(ajx_room>0){
mpt=eeL.value;
ajx_toid=ajx_user;
ajx_sndd=q;
eeL.value=r
set_post();ajx_toid=0;eeL.value=mpt;
eeK.style.display='none';fc()}}

/* --- */

function show_colors(){
if(ajx_room!=0){
if(eeF.style.display!='block'){
reset_some();eeF.style.display='block'}
else{reset_some()}fc()}}

/* --- */

function show_sound(){
if(ajx_room>0){
if(eeK.style.display=='none'){
reset_some();eeK.style.display='block'}
else{reset_some()}fc()}}

/* --- */

function show_smilies(){
if(ajx_room>0){
if(eeE.style.display!='block'){
reset_some();eeE.style.display='block';}
else{reset_some()}fc()}}

/* --- */

function show_time(){
if(ajx_room>0){
if(eeI.style.display=='none'){
reset_some();eeI.style.display='block'}
else{reset_some()}fc()}}

/* --- */

function show_user(s,t){
reset_some()
s=parseInt(s)
if(s<100000000||s>500000000){eeH.innerHTML='';user(s);}
else{eeH.innerHTML=' <div style="font-weight:bold" class="s">'+t+'<br /><br /></div>'}
eeG.style.display='block'
tmp=s;eeM.focus()}

/* --- */

function show_rname(p,q){p=parseInt(p)
eeA.innerHTML=q+' <span class="s">[<a href="info.php?reason=link" onclick="pp=window.open(\'history.php?room='+p+'\',\'history\',\'width=400,height=200,resizable=1,scrollbars=1\');pp.focus();return false">'+set_hist+'</a>]</span>'
}

/* --- */

function ban(){
id=parseInt(tmp)
if(!isNaN(id)&&id>0){
uri='ban.php?ban='+id
bnw=window.open(uri,'bn_win','width=300,height=200,resizable=1');
bnw.focus();}}

/* --- */

function room(){
if(lock2==0&&lock1==0){reset_all();r=rn();lock2=1;

s='ajx_user='+ajx_user+'&ajx_code='+ajx_code+'&ajx_name='+ajx_name+'&ajx_sess='+ajx_sess+'&rnd='+r;
http_room.open('post','rooms.php');
http_room.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
http_room.onreadystatechange=room_answer;http_room.send(s)}}

/* --- */

function chat(){
if(ajx_room>0&&lock1==0){
eeD.style.display='none';
eeJ.style.display='inline';
r=rn();lock1=1;
if(typeof room_tout=='number'){clearTimeout(room_tout)}
s='ajx_user='+ajx_user+'&ajx_name='+ajx_name+'&ajx_code='+ajx_code+'&ajx_funn='+ajx_funn+'&ajx_sess='+ajx_sess+'&ajx_last='+ajx_last+'&ajx_room='+ajx_room+'&ajx_zone='+ajx_zone+'&ajx_tfrm='+ajx_tfrm+'&ajx_toid='+ajx_toid+'&rnd='+r;
http_chat.open('post','aroom.php');
if(ajx_line!=''){
per=/%/g;ajx_line=ajx_line.replace(per,'%25');
amp=/&/g;ajx_line=ajx_line.replace(amp,'%26');
pl=/\+/g;ajx_line=ajx_line.replace(pl,'%2B');
s=s+'&ajx_line='+ajx_line+'&ajx_lbiu='+ajx_lbiu+'&ajx_lclr='+ajx_lclr}ajx_line='';
http_chat.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
http_chat.onreadystatechange=chat_answer;http_chat.send(s);}}

/* --- */

function user(q){q=parseInt(q)
if(q<100000000 || q>500000000){
if(ajx_room>0&&lock3==0){r=rn();lock3=1;q=parseInt(q)
s='ajx_user='+ajx_user+'&ajx_name='+ajx_name+'&ajx_code='+ajx_code+'&ajx_sess='+ajx_sess+'&ajx_unfo='+q+'&set_extn='+set_extn+'&rnd='+r;
http_user.open('post','user.php');
http_user.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
http_user.onreadystatechange=user_answer;http_user.send(s);}}}

/* --- */

function user_answer(){
if(http_user.readyState==4){
response=http_user.responseText.toString()
if(response.length<2){response=parseInt(response)}
if(!isNaN(response)&&response>0){
if(sup_errs<1){url='info.php?reason='+response;go(url)}
else{document.getElementById('dvG').style.display='none';}
}else{eeH.innerHTML=response}lock3=0;}}

/* --- */

function room_answer(){
if(http_room.readyState==4){
nidd=q0();midd=0;lock4=0;
response=http_room.responseText.toString()
if(response.length<2){response=parseInt(response)}
if(!isNaN(response)&&response>0){
if(sup_errs<1){url='info.php?reason='+response;go(url)}
else{room_tout=setTimeout('room()',set_refr*2000);}
}else{

eeD.style.display='block'
rooms='<div style="width:400px;margin:auto"><table style="width:100%" class="d" cellspacing="1"><tr class="b"><td colspan="2" class="b"><div class="u">'+set_rnme+'</div></td></tr>'

response=response.toString();
lines=response.split('^');
for(i=0;i<lines.length;i++){
aline=lines[i].toString()
aline=aline.split('|');
if(aline[3]){
cu=parseInt(aline[3]);midd+=cu;
rooms=rooms+'<tr class="c"><td class="c" style="padding:12px">';
if(cu<set_uspr){rooms=rooms+'<a class="u" href="info.php?reason=link" onclick="if(lock4==0){show_rname('+aline[0]+',\''+aline[1]+'\');ajx_room='+aline[0]+';chat()};return false"><b>'+aline[1]+'</b></a>'}
else{rooms=rooms+'<b class="u">'+aline[1]+'</b>'}
rooms=rooms+'<div class="s">'+aline[2]+'</div></td><td style="text-align:center" class="s">&nbsp;'+set_onle+': '+aline[3]+'&nbsp;</td></tr>';
}}
rooms=rooms+'</table></div>'
eeD.innerHTML=rooms}if(midd>nidd){lock4=1;}
lock2=0;room_tout=setTimeout('room()',set_refr*2000);}}

/* --- */

function chat_answer(){

if(http_chat.readyState==4){
eeB.style.display='block'
eeC.style.display='block'
document.getElementById('inpt').style.visibility='visible'
response=http_chat.responseText.toString();
if(response.length<2){response=parseInt(response)}
if(!isNaN(response)&&response>0){
if(sup_errs<1){url='info.php?reason='+response;go(url);}
else{chat_tout=setTimeout('chat()',set_refr*1000);}
}else{
online='<div class="b">'+set_onle+'</div><div style="padding:5px;overflow:auto;height:90%">';
addlns='';

response=response.toString();
reply=response.split('^');

if(!reply[4]){
if(sup_errs<1){url='info.php?reason='+response;go(url);}
else{chat_tout=setTimeout('chat()',set_refr*1000);}
}else{
slast=reply[0].toString()
lines=reply[1].toString()
users=reply[2].toString()
queri=reply[3].toString()
ttrun=reply[4].toString()

ajx_last=slast

users=users.split('|')
for(i=0;i<users.length;i++){
aline=users[i].toString()
aline=aline.split('*');
if(parseInt(aline[1])==parseInt(ajx_user)){dtt=' &not;'}else{dtt=''}
online=online+'<a href="info.php?reason=link" title="'+set_usri+'" class="o" onclick="show_user('+aline[1]+',\''+aline[0]+'\');return false">&middot; '+aline[0]+dtt+'</a><br />'
}

lines=lines.split('|')
for(i=0;i<lines.length;i++){
aline=lines[i].toString()
aline=aline.split('*');
if(aline[3]){
tmm=aline[0].toString()
usr=aline[1].toString()
too=aline[2].toString()

undr='<b>';
if(tmm.length>1){tmm='<span class="s">['+tmm+']</span> '}

if(too.length>1){undr='<b style="text-decoration:underline">';
whsp=' [<b>&raquo;</b>] '+undr+too+'</b>'}else{whsp=''}

if(usr.length>1){usr=undr+usr+'</b>'+whsp+':'
usr='<span class="s">'+usr+'</span>'}
addlns=addlns+tmm+usr+' '+aline[3]+'<br />'
}}

if(addlns.length>9){
txt=decr_lines(txt);txt=txt+addlns
if(ajx_sndd==1){allow_flash=flash}else{allow_flash=''}
eeB.innerHTML=txt+allow_flash}

eeC.innerHTML=online+'</div>'
eeB.scrollTop=999999

if(ajx_user=='1'){
document.getElementById('reqt').innerHTML=ttrun;
document.getElementById('quer').innerHTML=' ['+queri+']'
}}
lock1=0;connected();chat_tout=setTimeout('chat()',set_refr*1000);}}}

/* --- */

function decr_lines(t){l=30;a=t.split('<br />')
if(a.length>l){b=a.length-l;t='';
for(i=b;i<a.length;i++){t=t+'<br />'+a[i]}
}return t}

/* --- */

function elements(){
eeA=document.getElementById('dvA')
eeB=document.getElementById('dvB')
eeC=document.getElementById('dvC')
eeD=document.getElementById('dvD')
eeE=document.getElementById('dvE')
eeF=document.getElementById('dvF')
eeG=document.getElementById('dvG')
eeH=document.getElementById('dvH')
eeI=document.getElementById('dvI')
eeJ=document.getElementById('dvJ')
eeK=document.getElementById('dvK')
eeL=document.getElementById('ln')
eeM=document.getElementById('pm')
}
