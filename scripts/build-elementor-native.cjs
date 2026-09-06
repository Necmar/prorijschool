// Generates editable Elementor containers and regular widgets; no HTML/code widgets or custom CSS.
const fs=require('node:fs');
const out='design/elementor';fs.mkdirSync(out,{recursive:true});
let counter=0xabc1000;
const id=()=> (++counter).toString(16);
const px=size=>({unit:'px',size,sizes:[]});
const pct=size=>({unit:'%',size,sizes:[]});
const box=(t=0,r=t,b=t,l=r)=>({unit:'px',top:String(t),right:String(r),bottom:String(b),left:String(l),isLinked:false});
const gap=(n=0)=>({unit:'px',size:n,column:String(n),row:String(n),isLinked:true});
const font=(size,weight=400,line=1.6)=>({typography_typography:'custom',typography_font_family:'Public Sans',typography_font_size:px(size),typography_font_weight:String(weight),typography_line_height:{unit:'em',size:line},__globals__:{}});
const widget=(type,label,settings)=>({id:id(),elType:'widget',widgetType:type,isInner:false,settings:{_title:label,_margin:box(),...settings},elements:[]});
const container=(label,settings,elements=[])=>({id:id(),elType:'container',isInner:false,settings:{_title:label,container_type:'flex',content_width:'full',flex_direction:'column',flex_gap:gap(),padding:box(),...settings},elements});
const heading=(label,text,size,color,extra={})=>widget('heading',label,{title:text,header_size:'p',title_color:color,...font(size),...extra});
const button=(label,text,url,extra={})=>widget('button',label,{text,link:{url,is_external:'',nofollow:''},align:'left',button_text_color:'#ffffff',background_color:'#BD4528',hover_color:'#ffffff',button_background_hover_color:'#9C351F',border_radius:box(12),text_padding:box(17,24),...font(15,600,1.35),...extra});
const textLink=(label,text,url,color='#BFCCD2',extra={})=>button(label,text,url,{button_text_color:color,background_color:'#00000000',hover_color:'#FFB68A',button_background_hover_color:'#00000000',text_padding:box(12,0),border_radius:box(),...font(15,400,1.5),...extra});
const shell=(label,color,padding,elements,extra={})=>container(label,{content_width:'boxed',boxed_width:px(1160),background_background:'classic',background_color:color,padding,padding_tablet:box(32,24),padding_mobile:box(32,20),...extra},elements);

const invitation=shell('Uitnodigingsbalk','#F1EDE5',box(44,40),[
 container('Uitnodiging — tekst',{width:pct(72),width_tablet:pct(67),width_mobile:pct(100),flex_gap:gap(12)},[
  heading('Bovenregel','JOUW VOLGENDE STAP',12,'#9C3B23',{...font(12,700,1.5),typography_letter_spacing:px(1.5)}),
  heading('Uitnodiging — titel','Samen op weg naar je rijbewijs.',38,'#162C3B',{header_size:'h2',...font(38,700,1.18),typography_font_size_tablet:px(29),typography_font_size_mobile:px(29),typography_letter_spacing:px(-1)}),
  heading('Uitnodiging — toelichting','Begin met een proefles. Ontdek hoe jij je prettig voelt achter het stuur.',16,'#52616B',{_element_width:'initial',_element_custom_width:px(510),_element_custom_width_mobile:pct(100)})
 ]),
 button('Uitnodiging — proeflesknop','Plan mijn proefles ↗','/#aanvraag',{_element_width:'auto',_element_width_mobile:'inherit',align_mobile:'justify',text_padding_tablet:box(17,20)})
],{_element_id:'pro-uitnodiging-native',html_tag:'section',flex_direction:'row',flex_direction_mobile:'column',flex_align_items:'center',flex_align_items_mobile:'stretch',flex_justify_content:'space-between',flex_gap:gap(24)});

const links=(label,items)=>container(label,{width:pct(24),width_mobile:pct(46),flex_gap:gap(0)},[
 heading(label+' — kop',label,13,'#FFFFFF',{header_size:'h3',...font(13,700,1.5),_margin:box(7,0,16),_margin_mobile:box(0,0,10)}),
 ...items.map(([text,url])=>textLink(text,text,url,'#BFCCD2',{typography_font_size_mobile:px(14),...(['Pakketten & tarieven','Veelgestelde vragen'].includes(text)?{align:'justify',content_align:'start'}:{})}))
]);
const footer=shell('Footer','#162C3B',box(58,40,24),[
 container('Footer — kolommen',{flex_direction:'row',flex_direction_mobile:'row',flex_wrap:'wrap',flex_justify_content:'space-between',flex_gap:gap(28),flex_gap_mobile:gap(12),padding:box(0,0,48),padding_mobile:box(0,0,30)},[
  container('Footer — merk',{width:pct(40),width_mobile:pct(100),flex_gap:gap(18)},[
   heading('Merknaam','Prorijschool.',28,'#FFFFFF',{link:{url:'/'},...font(28,700,1.3),typography_letter_spacing:px(-1)}),
   heading('Merk — toelichting','Leren rijden met aandacht voor jou. Stap voor stap, op jouw tempo en met vertrouwen de weg op.',15,'#BFCCD2',{...font(15,400,1.85),_element_width:'initial',_element_custom_width:px(295),_element_custom_width_mobile:pct(100)})
  ]),
  links('Jouw rijopleiding',[['Rijlessen','/#opleidingen'],['Pakketten & tarieven','/#pakketten'],['Theorie','/#theorie']]),
  links('We helpen je op weg',[['Veelgestelde vragen','/#vragen'],['Proefles aanvragen','/#aanvraag']])
 ]),
 container('Footer — onderbalk',{flex_direction:'row',flex_direction_mobile:'column',flex_align_items:'center',flex_align_items_mobile:'flex-start',flex_justify_content:'space-between',flex_gap:gap(8),border_border:'solid',border_width:box(1,0,0),border_color:'#FFFFFF21',padding:box(22,0,0)},[
  heading('Copyright','© 2026 Prorijschool. Alle rechten voorbehouden.',12,'#BFCCD2',{...font(12,400,1.7),_element_width:'auto'}),
  textLink('Terug naar boven','Terug naar boven ↑','#','#E5ECEE',{...font(13,400,1.5),_element_width:'auto'})
 ])
],{_element_id:'pro-footer-native',padding_mobile:box(36,20,18)});

const header=shell('Header','#FFFFFF',box(18,32),[
 container('Header — hoofdregel',{flex_direction:'row',flex_align_items:'center',flex_justify_content:'space-between',flex_wrap:'nowrap',flex_gap:gap(16),flex_gap_mobile:gap(8)},[
  heading('Header — merknaam','Prorijschool',24,'#162C3B',{link:{url:'/'},...font(24,700,1.2),typography_letter_spacing:px(-1.1),typography_font_size_mobile:px(19),_element_width:'auto',_flex_order_tablet:'start'}),
  widget('nav-menu','Header — hoofdmenu',{menu:'hoofdmenu',menu_name:'Hoofdnavigatie',layout:'horizontal',align_items:'center',pointer:'underline',animation_line:'fade',dropdown:'tablet',full_width:'stretch',toggle:'burger',toggle_align:'right',color_menu_item:'#405664',color_menu_item_hover:'#BD4528',color_menu_item_active:'#405664',menu_typography_typography:'custom',menu_typography_font_family:'Public Sans',menu_typography_font_size:px(14),menu_typography_font_weight:'500',padding_horizontal_menu_item:px(10),padding_vertical_menu_item:px(14),color_dropdown_item:'#162C3B',background_color_dropdown_item:'#FFFFFF',color_dropdown_item_hover:'#A43820',background_color_dropdown_item_hover:'#F2F6F7',dropdown_typography_typography:'custom',dropdown_typography_font_family:'Public Sans',dropdown_typography_font_size:px(16),dropdown_typography_font_weight:'400',padding_horizontal_dropdown_item:px(24),padding_vertical_dropdown_item:px(18),toggle_size:px(22),toggle_color:'#162C3B',toggle_background_color:'#F2F6F7',toggle_border_radius:px(12),toggle_border_width:px(1),_element_width:'auto',_flex_order_tablet:'end',__globals__:{}}),
  container('Header — acties',{width:{unit:'px',size:'auto'},flex_direction:'row',flex_align_items:'center',flex_justify_content:'flex-end',flex_gap:gap(16),flex_gap_mobile:gap(0),_flex_order_tablet:'custom',_flex_order_custom_tablet:2},[
   textLink('Inloggen','Inloggen','/inloggen/','#405664',{...font(14,400,1.4),hide_mobile:'hidden-mobile',_element_width:'auto'}),
   button('Proefles — desktop en tablet','Proefles boeken','/#aanvraag',{...font(14,600,1.3),text_padding:box(15,20),hide_mobile:'hidden-mobile',_element_width:'auto'}),
   button('Proefles — mobiel','Proefles','/#aanvraag',{...font(13,600,1.3),text_padding:box(14,12),hide_desktop:'hidden-desktop',hide_tablet:'hidden-tablet',_element_width:'auto'})
  ])
 ]),
 textLink('Inloggen — mobiel','Inloggen','/inloggen/','#405664',{...font(14,400,1.4),align:'right',hide_desktop:'hidden-desktop',hide_tablet:'hidden-tablet',text_padding:box(10,0,0)})
],{_element_id:'pro-header-native',boxed_width:px(1440),padding_tablet:box(16,24),padding_mobile:box(14,16),border_border:'solid',border_width:box(0,0,1),border_color:'#E5EBED'});
for(const [name,content] of [['footer-native',[invitation,footer]],['header-native',[header]]]){
 const data={version:'0.4',title:'Prorijschool — '+name,type:'container',page_settings:[],content};
 fs.writeFileSync(`${out}/${name}.json`,JSON.stringify(data,null,2));
 console.log(`${name}: ${JSON.stringify(content).length} bytes`);
}
