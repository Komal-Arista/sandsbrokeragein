import{G as w,O as j}from"./constants.a8a14dc3.js";import{k as R,l as C,b as M,u as B}from"./index.506b73e8.js";import{u as z}from"./Image.eac7d757.js";import{u as E}from"./MaxCounts.7c38e980.js";import{a as K}from"./helpers.3ed33f4a.js";import{B as Y}from"./RadioToggle.333e7750.js";import{C as W}from"./Caret.a21d4ca8.js";import{C as J}from"./Card.d0e52e4a.js";import{C as q}from"./FacebookPreview.4a72971b.js";import{C as Q}from"./HtmlTagsEditor.47bd1130.js";import{C as X}from"./ImageUploader.831f991b.js";import{C as Z}from"./SettingsRow.ac18ea66.js";import{S as $}from"./Book.74a13fcd.js";import{T as ee,a as oe}from"./Row.2a867ba6.js";import"./translations.d159963e.js";import{_ as te}from"./_plugin-vue_export-helper.eefbdd86.js";import{_ as n,s as I}from"./default-i18n.20001971.js";import{c as v,C as l,l as s,k as c,b as m,v as u,o as r,a as d,x as k,t as p,F as G,J as H}from"./runtime-dom.esm-bundler.5c3c7d72.js";import"./helpers.53868b98.js";import"./metabox.a04ab80a.js";import"./cleanForSlug.97664b33.js";import"./toString.f0787db8.js";import"./_baseTrim.11b89ad9.js";import"./_stringToArray.f9ddb970.js";import"./_baseSet.9f9da1bd.js";import"./regex.8a6101c0.js";import"./Tooltip.73441134.js";import"./index.b359096c.js";import"./Slide.39c07c03.js";import"./Img.dcdcf2f4.js";import"./Profile.ad607616.js";import"./Editor.590cac0d.js";import"./isEqual.96d3394c.js";import"./_baseIsEqual.aba7ca44.js";import"./_getTag.1e50d0c4.js";import"./_baseClone.f4be2bb9.js";import"./_arrayEach.6af5abac.js";import"./UnfilteredHtml.d5db3c8d.js";import"./Plus.426117bd.js";import"./Row.df38a5f6.js";const i="all-in-one-seo-pack",ae={setup(){const{getImageSourceOption:_,getTermImageSourceOptions:t,imageSourceOptions:h}=z(),{maxRecommendedCount:e}=E(),{parseTags:a}=K({separator:void 0});return{GLOBAL_STRINGS:w,getImageSourceOption:_,getTermImageSourceOptions:t,imageSourceOptions:h,licenseStore:R(),links:C,maxRecommendedCount:e,optionsStore:M(),parseTags:a,rootStore:B()}},components:{BaseRadioToggle:Y,CoreAlert:W,CoreCard:J,CoreFacebookPreview:q,CoreHtmlTagsEditor:Q,CoreImageUploader:X,CoreSettingsRow:Z,SvgBook:$,TableColumn:ee,TableRow:oe},data(){return{siteNameCount:0,titleCount:0,descriptionCount:0,option:null,pagePostOptions:[],strings:{generalFacebookSettings:n("General Facebook Settings",i),description:n("Enable this feature if you want Facebook and other social media to display a preview with images and a text excerpt when a link to your site is shared.",i),enableOpenGraph:n("Enable Open Graph Markup",i),defaultImageSourcePosts:n("Default Post Image Source",i),defaultImageSourceTerms:n("Default Term Image Source",i),width:n("Width",i),height:n("Height",i),postCustomFieldName:n("Post Custom Field Name",i),termsCustomFieldName:n("Term Custom Field Name",i),defaultFacebookImagePosts:n("Default Post Facebook Image",i),defaultFacebookImageTerms:n("Default Term Facebook Image",i),minimumSize:n("Minimum size: 200px x 200px, ideal ratio 1.91:1, 8MB max. (eg: 1640px x 856px or 3280px x 1712px for Retina screens). JPG, PNG, WEBP and GIF formats only.",i),homePageSettings:n("Home Page Settings",i),exampleSiteTitle:n("The Title of the Page or Site you are Sharing",i),exampleSiteDescription:I(n("This is what your page configured with %1$s will look like when shared via Facebook. The site title and description will be automatically added.",i),"AIOSEO"),homePageImage:n("Image",i),siteName:n("Site Name",i),homePageTitle:n("Title",i),useHomePageTitle:n("Use the home page title",i),clickToAddSiteName:n("Click on the tags below to insert variables into your site name.",i),clickToAddHomePageTitle:n("Click on the tags below to insert variables into your home page title.",i),homePageDescription:n("Description",i),useHomePageDescription:n("Use the home page description",i),clickToAddHomePageDescription:n("Click on the tags below to insert variables into your description.",i),advancedSettings:n("Advanced Settings",i),facebookAdminId:n("Facebook Admin ID",i),facebookAppId:n("Facebook App ID",i),facebookAuthorUrl:n("Facebook Author URL",i),facebookAdminIdDescription:n("Enter your Facebook Admin ID here. You can enter multiple Facebook Admin IDs by separating them with a comma.",i),facebookAppIdDescription:n("The Facebook App ID of the site's app. In order to use Facebook Insights, you must add the App ID to your page. Insights lets you view analytics for traffic to your site from Facebook. Find the App ID in your App Dashboard.",i),facebookAuthorUrlDescription:n("Will be overriden if the Facebook author URL is present in the individual User Profile.",i),howToGetAdminId:n("How to get your Facebook Admin ID",i),howToGetAppId:n("How to get your Facebook App ID",i),howToGetAuthorUrl:n("How to get your Facebook Author URL",i),showFacebookAuthor:n("Show Facebook Author",i),postTypeObjectTypes:n("Default Post Type Object Types",i),taxonomyObjectTypes:n("Default Taxonomy Object Types",i),taxonomyObjectTypesUpsell:I(n("Default Taxonomy Object Types is a %1$s feature. %2$s",i),"PRO",C.getUpsellLink("general-facebook-settings",w.learnMore,"default-taxonomy-object-types",!0)),defaultTermImageSourceUpsell:I(n("Default Term Image Source is a %1$s feature. %2$s",i),"PRO",C.getUpsellLink("general-facebook-settings",w.learnMore,"default-term-image-source",!0)),generateArticleTags:n("Automatically Generate Article Tags",i),useKeywordsInTags:n("Use Keywords in Article Tags",i),useCategoriesInTags:n("Use Categories in Article Tags",i),usePostTagsInTags:n("Use Post Tags in Article Tags",i),homePageDisabledDescription:I(n("You are using a static home page which is found under Pages. You can %1$sedit your home page settings%2$s directly to change the title, meta description and image.",i),`<a href="${this.rootStore.aioseo.urls.staticHomePage}&aioseo-tab=social&social-tab=facebook&aioseo-scroll=aioseo-post-settings-facebook&aioseo-highlight=aioseo-post-settings-facebook">`,"</a>"),objectType:n("Object Type",i)}}},computed:{objectTypeOptions(){return j},previewTitle(){return this.rootStore.aioseo.data.staticHomePage?this.parseTags(this.rootStore.aioseo.data.staticHomePageOgTitle||"#site_title"):this.parseTags(this.optionsStore.options.social.facebook.homePage.title||"#site_title")},previewDescription(){return this.rootStore.aioseo.data.staticHomePage?this.parseTags(this.rootStore.aioseo.data.staticHomePageOgDescription||"#tagline"):this.parseTags(this.optionsStore.options.social.facebook.homePage.description||"#tagline")}},methods:{getObjectTypeOptions(_){let t=null;return this.objectTypeOptions.forEach(h=>{const e=h.options.find(a=>a.value===_);e&&(t=e)}),t}}},ne={class:"aioseo-facebook"},ie={class:"aioseo-settings-row aioseo-section-description"},se=["innerHTML"],le=["innerHTML"],re=["innerHTML"],ce=["innerHTML"],me={key:0,class:"aioseo-settings-row aioseo-section-description"},ge=["innerHTML"],de=["innerHTML"],pe=["innerHTML"],ue=["innerHTML"],be={class:"aioseo-description"},fe={class:"aioseo-description how-to"},ke=["href"],Se=["href"],Te={class:"aioseo-description"},_e={class:"aioseo-description how-to"},he=["href"],ye=["href"],Ie={class:"aioseo-description"},ve={class:"aioseo-description how-to"},Ae=["href"],Ve=["href"];function Pe(_,t,h,e,a,b){const D=u("base-toggle"),g=u("core-settings-row"),f=u("base-select"),S=u("base-input"),A=u("core-image-uploader"),x=u("core-alert"),y=u("table-column"),F=u("table-row"),T=u("base-radio-toggle"),V=u("core-html-tags-editor"),P=u("core-card"),N=u("core-facebook-preview"),O=u("svg-book");return r(),v("div",ne,[l(P,{slug:"facebook","header-text":a.strings.generalFacebookSettings},{default:s(()=>[d("div",ie,[k(p(a.strings.description)+" ",1),d("span",{innerHTML:e.links.getDocLink(e.GLOBAL_STRINGS.learnMore,"facebook",!0)},null,8,se)]),l(g,{name:a.strings.enableOpenGraph},{content:s(()=>[l(D,{modelValue:e.optionsStore.options.social.facebook.general.enable,"onUpdate:modelValue":t[0]||(t[0]=o=>e.optionsStore.options.social.facebook.general.enable=o)},null,8,["modelValue"])]),_:1},8,["name"]),e.optionsStore.options.social.facebook.general.enable?(r(),c(g,{key:0,class:"facebook-default-image-source",name:a.strings.defaultImageSourcePosts,align:""},{content:s(()=>[l(f,{size:"medium",options:e.imageSourceOptions,modelValue:e.getImageSourceOption(e.optionsStore.options.social.facebook.general.defaultImageSourcePosts),"onUpdate:modelValue":t[1]||(t[1]=o=>e.optionsStore.options.social.facebook.general.defaultImageSourcePosts=o.value)},null,8,["options","modelValue"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable&&e.optionsStore.options.social.facebook.general.defaultImageSourcePosts==="custom"?(r(),c(g,{key:1,name:a.strings.postCustomFieldName,align:""},{content:s(()=>[l(S,{size:"medium",modelValue:e.optionsStore.options.social.facebook.general.customFieldImagePosts,"onUpdate:modelValue":t[2]||(t[2]=o=>e.optionsStore.options.social.facebook.general.customFieldImagePosts=o)},null,8,["modelValue"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable?(r(),c(g,{key:2,class:"facebook-image",name:a.strings.defaultFacebookImagePosts,align:""},{content:s(()=>[l(A,{description:a.strings.minimumSize,modelValue:e.optionsStore.options.social.facebook.general.defaultImagePosts,"onUpdate:modelValue":t[3]||(t[3]=o=>e.optionsStore.options.social.facebook.general.defaultImagePosts=o)},null,8,["description","modelValue"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable?(r(),c(g,{key:3,class:"facebook-default-image-source",name:a.strings.defaultImageSourceTerms,align:""},{content:s(()=>[e.licenseStore.isUnlicensed?m("",!0):(r(),c(f,{key:0,size:"medium",options:e.getTermImageSourceOptions(),modelValue:e.getImageSourceOption(e.optionsStore.options.social.facebook.general.defaultImageSourceTerms),"onUpdate:modelValue":t[4]||(t[4]=o=>e.optionsStore.options.social.facebook.general.defaultImageSourceTerms=o.value)},null,8,["options","modelValue"])),e.licenseStore.isUnlicensed?(r(),c(f,{key:1,size:"medium",options:e.getTermImageSourceOptions(),modelValue:e.getImageSourceOption("default"),disabled:""},null,8,["options","modelValue"])):m("",!0),e.licenseStore.isUnlicensed?(r(),c(x,{key:2,class:"inline-upsell",type:"blue"},{default:s(()=>[d("div",{innerHTML:a.strings.defaultTermImageSourceUpsell},null,8,le)]),_:1})):m("",!0)]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable&&e.optionsStore.options.social.facebook.general.defaultImageSourceTerms==="custom"&&!e.licenseStore.isUnlicensed?(r(),c(g,{key:4,name:a.strings.termsCustomFieldName,align:""},{content:s(()=>[l(S,{size:"medium",modelValue:e.optionsStore.options.social.facebook.general.customFieldImageTerms,"onUpdate:modelValue":t[5]||(t[5]=o=>e.optionsStore.options.social.facebook.general.customFieldImageTerms=o)},null,8,["modelValue"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable&&!e.licenseStore.isUnlicensed?(r(),c(g,{key:5,class:"facebook-image",name:a.strings.defaultFacebookImageTerms,align:""},{content:s(()=>[l(A,{description:a.strings.minimumSize,modelValue:e.optionsStore.options.social.facebook.general.defaultImageTerms,"onUpdate:modelValue":t[6]||(t[6]=o=>e.optionsStore.options.social.facebook.general.defaultImageTerms=o)},null,8,["description","modelValue"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable?(r(),c(g,{key:6,name:a.strings.postTypeObjectTypes,align:""},{content:s(()=>[(r(!0),v(G,null,H(e.rootStore.aioseo.postData.postTypes,(o,U)=>(r(),c(F,{class:"facebook-object-types",key:U},{default:s(()=>[l(y,null,{default:s(()=>[k(p(o.label),1)]),_:2},1024),l(y,null,{default:s(()=>[l(f,{size:"medium",options:b.objectTypeOptions,"group-label":"groupLabel","group-values":"options",modelValue:b.getObjectTypeOptions(e.optionsStore.dynamicOptions.social.facebook.general.postTypes[o.name].objectType),"onUpdate:modelValue":L=>e.optionsStore.dynamicOptions.social.facebook.general.postTypes[o.name].objectType=L.value},null,8,["options","modelValue","onUpdate:modelValue"])]),_:2},1024)]),_:2},1024))),128))]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable?(r(),c(g,{key:7,name:a.strings.taxonomyObjectTypes,align:""},{content:s(()=>[(r(!0),v(G,null,H(e.rootStore.aioseo.postData.taxonomies,(o,U)=>(r(),c(F,{class:"facebook-object-types",key:U},{default:s(()=>[l(y,null,{default:s(()=>[k(p(o.label)+" ("+p(o.name)+") ",1)]),_:2},1024),l(y,null,{default:s(()=>[e.licenseStore.isUnlicensed?m("",!0):(r(),c(f,{key:0,size:"medium",options:b.objectTypeOptions,"group-label":"groupLabel","group-values":"options",modelValue:b.getObjectTypeOptions(e.optionsStore.dynamicOptions.social.facebook.general.taxonomies[o.name].objectType),"onUpdate:modelValue":L=>e.optionsStore.dynamicOptions.social.facebook.general.taxonomies[o.name].objectType=L.value},null,8,["options","modelValue","onUpdate:modelValue"])),e.licenseStore.isUnlicensed?(r(),c(f,{key:1,size:"medium",options:b.objectTypeOptions,"group-label":"groupLabel","group-values":"options",modelValue:b.getObjectTypeOptions("article"),disabled:""},null,8,["options","modelValue"])):m("",!0)]),_:2},1024)]),_:2},1024))),128)),e.licenseStore.isUnlicensed?(r(),c(x,{key:0,class:"inline-upsell",type:"blue"},{default:s(()=>[d("div",{innerHTML:a.strings.taxonomyObjectTypesUpsell},null,8,re)]),_:1})):m("",!0)]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable?(r(),c(g,{key:8,name:a.strings.showFacebookAuthor,align:""},{content:s(()=>[l(T,{modelValue:e.optionsStore.options.social.facebook.general.showAuthor,"onUpdate:modelValue":t[7]||(t[7]=o=>e.optionsStore.options.social.facebook.general.showAuthor=o),name:"showFacebookAuthor",options:[{label:e.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.GLOBAL_STRINGS.yes,value:!0}]},null,8,["modelValue","options"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.general.enable?(r(),c(g,{key:9,name:a.strings.siteName,align:""},{content:s(()=>[l(V,{class:"facebook-meta-input",modelValue:e.optionsStore.options.social.facebook.general.siteName,"onUpdate:modelValue":t[8]||(t[8]=o=>e.optionsStore.options.social.facebook.general.siteName=o),"line-numbers":!1,single:"",onCounter:t[9]||(t[9]=o=>a.siteNameCount=o.length),"tags-context":"homePage","default-tags":["site_title","tagline","separator_sa"]},{"tags-description":s(()=>[k(p(a.strings.clickToAddSiteName),1)]),_:1},8,["modelValue"]),d("div",{class:"max-recommended-count",innerHTML:e.maxRecommendedCount(a.siteNameCount,95)},null,8,ce)]),_:1},8,["name"])):m("",!0)]),_:1},8,["header-text"]),e.optionsStore.options.social.facebook.general.enable?(r(),c(P,{key:0,slug:"facebookHomePageSettings","header-text":a.strings.homePageSettings},{default:s(()=>[e.rootStore.aioseo.data.staticHomePage?(r(),v("div",me,[d("span",{innerHTML:a.strings.homePageDisabledDescription},null,8,ge),k("   "),d("span",{innerHTML:e.links.getDocLink(e.GLOBAL_STRINGS.learnMore,"staticHomePageFacebook",!0)},null,8,de)])):m("",!0),l(g,{name:e.GLOBAL_STRINGS.preview},{content:s(()=>[l(N,{description:b.previewDescription,image:e.optionsStore.options.social.facebook.homePage.image,title:b.previewTitle},null,8,["description","image","title"])]),_:1},8,["name"]),e.rootStore.aioseo.data.staticHomePage?m("",!0):(r(),c(g,{key:1,class:"facebook-image",name:a.strings.homePageImage},{content:s(()=>[l(A,{description:a.strings.minimumSize,modelValue:e.optionsStore.options.social.facebook.homePage.image,"onUpdate:modelValue":t[10]||(t[10]=o=>e.optionsStore.options.social.facebook.homePage.image=o)},null,8,["description","modelValue"])]),_:1},8,["name"])),e.rootStore.aioseo.data.staticHomePage?m("",!0):(r(),c(g,{key:2,name:a.strings.homePageTitle,align:""},{content:s(()=>[l(V,{class:"facebook-meta-input",modelValue:e.optionsStore.options.social.facebook.homePage.title,"onUpdate:modelValue":t[11]||(t[11]=o=>e.optionsStore.options.social.facebook.homePage.title=o),"line-numbers":!1,single:"",onCounter:t[12]||(t[12]=o=>a.titleCount=o.length),"tags-context":"homePage","default-tags":["site_title","tagline","separator_sa"]},{"tags-description":s(()=>[k(p(a.strings.clickToAddHomePageTitle),1)]),_:1},8,["modelValue"]),d("div",{class:"max-recommended-count",innerHTML:e.maxRecommendedCount(a.titleCount,95)},null,8,pe)]),_:1},8,["name"])),e.rootStore.aioseo.data.staticHomePage?m("",!0):(r(),c(g,{key:3,name:a.strings.homePageDescription,align:""},{content:s(()=>[l(V,{class:"facebook-meta-input",modelValue:e.optionsStore.options.social.facebook.homePage.description,"onUpdate:modelValue":t[13]||(t[13]=o=>e.optionsStore.options.social.facebook.homePage.description=o),"line-numbers":!1,onCounter:t[14]||(t[14]=o=>a.descriptionCount=o.length),"tags-context":"homePage","default-tags":["site_title","tagline","separator_sa"]},{"tags-description":s(()=>[k(p(a.strings.clickToAddHomePageDescription),1)]),_:1},8,["modelValue"]),d("div",{class:"max-recommended-count",innerHTML:e.maxRecommendedCount(a.descriptionCount,200)},null,8,ue)]),_:1},8,["name"])),e.rootStore.aioseo.data.staticHomePage?m("",!0):(r(),c(g,{key:4,class:"facebook-home-page-object-type",name:a.strings.objectType,align:""},{content:s(()=>[l(f,{size:"medium",options:b.objectTypeOptions,"group-label":"groupLabel","group-values":"options",modelValue:b.getObjectTypeOptions(e.optionsStore.options.social.facebook.homePage.objectType),"onUpdate:modelValue":t[15]||(t[15]=o=>e.optionsStore.options.social.facebook.homePage.objectType=o.value)},null,8,["options","modelValue"])]),_:1},8,["name"]))]),_:1},8,["header-text"])):m("",!0),e.optionsStore.options.social.facebook.general.enable?(r(),c(P,{key:1,slug:"facebookAdvancedSettings",toggles:e.optionsStore.options.social.facebook.advanced.enable},{header:s(()=>[l(D,{modelValue:e.optionsStore.options.social.facebook.advanced.enable,"onUpdate:modelValue":t[16]||(t[16]=o=>e.optionsStore.options.social.facebook.advanced.enable=o)},null,8,["modelValue"]),d("span",null,p(a.strings.advancedSettings),1)]),default:s(()=>[l(g,{name:a.strings.facebookAdminId,align:""},{content:s(()=>[l(S,{size:"medium",modelValue:e.optionsStore.options.social.facebook.advanced.adminId,"onUpdate:modelValue":t[17]||(t[17]=o=>e.optionsStore.options.social.facebook.advanced.adminId=o)},null,8,["modelValue"]),d("div",be,p(a.strings.facebookAdminIdDescription),1),d("div",fe,[d("a",{class:"no-underline",href:e.links.getDocUrl("facebookAdminId"),target:"_blank"},[l(O)],8,ke),d("a",{href:e.links.getDocUrl("facebookAdminId"),target:"_blank"},p(a.strings.howToGetAdminId),9,Se)])]),_:1},8,["name"]),l(g,{name:a.strings.facebookAppId,align:""},{content:s(()=>[l(S,{size:"medium",modelValue:e.optionsStore.options.social.facebook.advanced.appId,"onUpdate:modelValue":t[18]||(t[18]=o=>e.optionsStore.options.social.facebook.advanced.appId=o)},null,8,["modelValue"]),d("div",Te,p(a.strings.facebookAppIdDescription),1),d("div",_e,[d("a",{class:"no-underline",href:e.links.getDocUrl("facebookAppId"),target:"_blank"},[l(O)],8,he),d("a",{href:e.links.getDocUrl("facebookAppId"),target:"_blank"},p(a.strings.howToGetAppId),9,ye)])]),_:1},8,["name"]),l(g,{name:a.strings.facebookAuthorUrl,align:""},{content:s(()=>[l(S,{size:"medium",modelValue:e.optionsStore.options.social.facebook.advanced.authorUrl,"onUpdate:modelValue":t[19]||(t[19]=o=>e.optionsStore.options.social.facebook.advanced.authorUrl=o)},null,8,["modelValue"]),d("div",Ie,p(a.strings.facebookAuthorUrlDescription),1),d("div",ve,[d("a",{class:"no-underline",href:e.links.getDocUrl("facebookAuthorUrl"),target:"_blank"},[l(O)],8,Ae),d("a",{href:e.links.getDocUrl("facebookAuthorUrl"),target:"_blank"},p(a.strings.howToGetAuthorUrl),9,Ve)])]),_:1},8,["name"]),l(g,{name:a.strings.generateArticleTags,align:""},{content:s(()=>[l(T,{modelValue:e.optionsStore.options.social.facebook.advanced.generateArticleTags,"onUpdate:modelValue":t[20]||(t[20]=o=>e.optionsStore.options.social.facebook.advanced.generateArticleTags=o),name:"generateArticleTags",options:[{label:e.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.GLOBAL_STRINGS.yes,value:!0}]},null,8,["modelValue","options"])]),_:1},8,["name"]),e.optionsStore.options.social.facebook.advanced.generateArticleTags?(r(),c(g,{key:0,name:a.strings.useKeywordsInTags,align:""},{content:s(()=>[l(T,{modelValue:e.optionsStore.options.social.facebook.advanced.useKeywordsInTags,"onUpdate:modelValue":t[21]||(t[21]=o=>e.optionsStore.options.social.facebook.advanced.useKeywordsInTags=o),name:"useKeywordsInTags",options:[{label:e.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.GLOBAL_STRINGS.yes,value:!0}]},null,8,["modelValue","options"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.advanced.generateArticleTags?(r(),c(g,{key:1,name:a.strings.useCategoriesInTags,align:""},{content:s(()=>[l(T,{modelValue:e.optionsStore.options.social.facebook.advanced.useCategoriesInTags,"onUpdate:modelValue":t[22]||(t[22]=o=>e.optionsStore.options.social.facebook.advanced.useCategoriesInTags=o),name:"useCategoriesInTags",options:[{label:e.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.GLOBAL_STRINGS.yes,value:!0}]},null,8,["modelValue","options"])]),_:1},8,["name"])):m("",!0),e.optionsStore.options.social.facebook.advanced.generateArticleTags?(r(),c(g,{key:2,name:a.strings.usePostTagsInTags,align:""},{content:s(()=>[l(T,{modelValue:e.optionsStore.options.social.facebook.advanced.usePostTagsInTags,"onUpdate:modelValue":t[23]||(t[23]=o=>e.optionsStore.options.social.facebook.advanced.usePostTagsInTags=o),name:"usePostTagsInTags",options:[{label:e.GLOBAL_STRINGS.no,value:!1,activeClass:"dark"},{label:e.GLOBAL_STRINGS.yes,value:!0}]},null,8,["modelValue","options"])]),_:1},8,["name"])):m("",!0)]),_:1},8,["toggles"])):m("",!0)])}const bo=te(ae,[["render",Pe]]);export{bo as default};
