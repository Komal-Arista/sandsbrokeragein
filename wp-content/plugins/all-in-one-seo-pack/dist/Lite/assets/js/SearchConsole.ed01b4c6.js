import{p as g,b as k}from"./index.506b73e8.js";import{u as w}from"./GoogleSearchConsole.d7d0dd26.js";import{u as W}from"./Wizard.387d446a.js";import{c as y}from"./Caret.a21d4ca8.js";import{S as x}from"./ConnectGoogleSearchConsole.ad9c3eab.js";import{W as b,a as A,b as B}from"./Header.11356250.js";import{W as G}from"./CloseAndExit.afeceba3.js";import{_ as L}from"./Steps.12a37c2b.js";import{_ as T}from"./_plugin-vue_export-helper.eefbdd86.js";import{u as F}from"./SetupWizardStore.cb089089.js";import{c as N,C as o,l as i,v as t,o as P,a as e,x as n,t as r}from"./runtime-dom.esm-bundler.5c3c7d72.js";import"./default-i18n.20001971.js";import"./helpers.53868b98.js";import"./translations.d159963e.js";import"./addons.9611ac49.js";import"./upperFirst.2cd99bdd.js";import"./_stringToArray.f9ddb970.js";import"./toString.f0787db8.js";import"./Logo.6c9d2b19.js";import"./Index.6c8fd7fc.js";const V={setup(){const{strings:l}=W({stage:"search-console"}),{connect:_,loading:p,strings:c}=w({returnTo:"setup-wizard"});return{composableStrings:g(l,c),connect:_,loading:p,optionsStore:k(),setupWizardStore:F()}},components:{SvgCircleCheck:y,SvgConnectGoogleSearchConsole:x,WizardBody:b,WizardCloseAndExit:G,WizardContainer:A,WizardHeader:B,WizardSteps:L},data(){return{strings:g(this.composableStrings,{})}},methods:{saveAndConnect(){this.loading=!0,this.setupWizardStore.saveWizard("searchConsole").then(()=>{this.connect()})},skipStep(){this.setupWizardStore.saveWizard(),this.$router.push(this.setupWizardStore.getNextLink)}}},E={class:"aioseo-wizard-search-console"},D={class:"header"},H={class:"aioseo-wizard-search-console__panel"},O={class:"aioseo-wizard-search-console__image"},R={class:"aioseo-wizard-search-console__content"},U={class:"aioseo-wizard-search-console__content-text"},Y={class:"aioseo-wizard-search-console__content-list"},j={class:"go-back"},q=e("div",{class:"spacer"},null,-1);function I(l,_,p,c,s,d){const h=t("wizard-header"),z=t("wizard-steps"),f=t("svg-connect-google-search-console"),a=t("svg-circle-check"),u=t("router-link"),m=t("base-button"),S=t("wizard-body"),v=t("wizard-close-and-exit"),C=t("wizard-container");return P(),N("div",E,[o(h),o(C,null,{default:i(()=>[o(S,null,{footer:i(()=>[e("div",j,[o(u,{to:c.setupWizardStore.getPrevLink,class:"no-underline"},{default:i(()=>[n("←")]),_:1},8,["to"]),n("   "),o(u,{to:c.setupWizardStore.getPrevLink},{default:i(()=>[n(r(s.strings.goBack),1)]),_:1},8,["to"])]),q,o(m,{type:"gray",onClick:d.skipStep},{default:i(()=>[n(r(s.strings.skipThisStep),1)]),_:1},8,["onClick"]),o(m,{type:"blue",loading:c.loading,onClick:d.saveAndConnect},{default:i(()=>[n(r(s.strings.connectToGoogleSearchConsole)+" →",1)]),_:1},8,["loading","onClick"])]),default:i(()=>[o(z),e("div",D,r(s.strings.connectToGoogleSearchConsole),1),e("div",H,[e("div",O,[o(f)]),e("div",R,[e("div",U,r(s.strings.syncYourSiteWithGsc),1),e("ul",Y,[e("li",null,[o(a),n(" "+r(s.strings.gscFeature1),1)]),e("li",null,[o(a),n(" "+r(s.strings.gscFeature2),1)]),e("li",null,[o(a),n(" "+r(s.strings.gscFeature3),1)]),e("li",null,[o(a),n(" "+r(s.strings.gscFeature4),1)])])])])]),_:1}),o(v)]),_:1})])}const mo=T(V,[["render",I]]);export{mo as default};
