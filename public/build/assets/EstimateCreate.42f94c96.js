var Q=Object.defineProperty,W=Object.defineProperties;var X=Object.getOwnPropertyDescriptors;var x=Object.getOwnPropertySymbols;var Z=Object.prototype.hasOwnProperty,ee=Object.prototype.propertyIsEnumerable;var L=(a,e,n)=>e in a?Q(a,e,{enumerable:!0,configurable:!0,writable:!0,value:n}):a[e]=n,j=(a,e)=>{for(var n in e||(e={}))Z.call(e,n)&&L(a,n,e[n]);if(x)for(var n of x(e))ee.call(e,n)&&L(a,n,e[n]);return a},q=(a,e)=>W(a,X(e));import{r as m,o as p,e as P,h as v,f as s,u as t,w as l,m as T,C as te,B as C,z as ae,aN as se,k as y,E as b,H as $,N as ne,J as oe,aP as ie,O as le,Y as re,l as E,j as I,t as M,i as me,P as de,F as ue}from"./vendor.5f3776de.js";import{k as F,r as ce,b as ge,m as pe}from"./main.d106ea19.js";import{_ as fe,a as _e,b as ve,c as be,d as ye,e as Ee,f as we}from"./SalesTax.e2712797.js";import{_ as $e}from"./CreateCustomFields.ab024ae7.js";import{_ as Be}from"./ExchangeRateConverter.1f928e84.js";import{_ as he}from"./TaxTypeModal.3b79a903.js";import"./DragIcon.04e30d7e.js";import"./SelectNotePopup.227c01c5.js";import"./NoteModal.512fcee1.js";import"./payment.5c30a157.js";import"./exchange-rate.45fbb74e.js";const Se={class:"md:grid-cols-12 grid-cols-1 md:gap-x-6 mt-6 mb-8 grid gap-y-5"},Ce={class:"col-span-12 lg:col-span-5"},Ie={class:"col-span-12 lg:col-span-7"},ke={props:{v:{type:Object,default:null},isLoading:{type:Boolean,default:!1},isEdit:{type:Boolean,default:!1}},setup(a){const e=F();return(n,o)=>{const B=m("BaseCustomerSelectPopup"),d=m("BaseDatePicker"),c=m("BaseInputGroup"),g=m("BaseInput"),h=m("BaseIcon"),S=m("BaseInputGrid");return p(),P("div",Se,[v("div",Ce,[s(B,{modelValue:t(e).newEstimate.customer,"onUpdate:modelValue":o[0]||(o[0]=i=>t(e).newEstimate.customer=i),valid:a.v.customer_id,"content-loading":a.isLoading,type:"estimate",class:"col-span-5 pr-0"},null,8,["modelValue","valid","content-loading"])]),v("div",Ie,[s(S,{class:"md:grid-cols-3"},{default:l(()=>[s(c,{label:n.$t("reports.estimates.estimate_date"),"content-loading":a.isLoading,required:"",error:a.v.estimate_date.$error&&a.v.estimate_date.$errors[0].$message},{default:l(()=>[s(d,{modelValue:t(e).newEstimate.estimate_date,"onUpdate:modelValue":o[1]||(o[1]=i=>t(e).newEstimate.estimate_date=i),"content-loading":a.isLoading,"calendar-button":!0,"calendar-button-icon":"calendar"},null,8,["modelValue","content-loading"])]),_:1},8,["label","content-loading","error"]),s(c,{label:n.$t("estimates.expiry_date"),"content-loading":a.isLoading},{default:l(()=>[s(d,{modelValue:t(e).newEstimate.expiry_date,"onUpdate:modelValue":o[2]||(o[2]=i=>t(e).newEstimate.expiry_date=i),"content-loading":a.isLoading,"calendar-button":!0,"calendar-button-icon":"calendar"},null,8,["modelValue","content-loading"])]),_:1},8,["label","content-loading"]),s(c,{label:n.$t("estimates.estimate_number"),"content-loading":a.isLoading,required:"",error:a.v.estimate_number.$error&&a.v.estimate_number.$errors[0].$message},{default:l(()=>[s(g,{modelValue:t(e).newEstimate.estimate_number,"onUpdate:modelValue":o[3]||(o[3]=i=>t(e).newEstimate.estimate_number=i),"content-loading":a.isLoading},null,8,["modelValue","content-loading"])]),_:1},8,["label","content-loading","error"]),s(c,{label:n.$t("estimates.ref_number"),"content-loading":a.isLoading,error:a.v.reference_number.$error&&a.v.reference_number.$errors[0].$message},{default:l(()=>[s(g,{modelValue:t(e).newEstimate.reference_number,"onUpdate:modelValue":o[4]||(o[4]=i=>t(e).newEstimate.reference_number=i),"content-loading":a.isLoading,onInput:o[5]||(o[5]=i=>a.v.reference_number.$touch())},{left:l(i=>[s(h,{name:"HashtagIcon",class:T(i.class)},null,8,["class"])]),_:1},8,["modelValue","content-loading"])]),_:1},8,["label","content-loading","error"]),s(Be,{store:t(e),"store-prop":"newEstimate",v:a.v,"is-loading":a.isLoading,"is-edit":a.isEdit,"customer-currency":t(e).newEstimate.currency_id},null,8,["store","v","is-loading","is-edit","customer-currency"])]),_:1})])])}}},Ve=["onSubmit"],xe={class:"flex"},Le={class:"block mt-10 estimate-foot lg:flex lg:justify-between lg:items-start"},je={class:"relative w-full lg:w-1/2"},Oe={setup(a){const e=F(),n=ce(),o=ge(),B=pe(),{t:d}=te(),c="newEstimate";let g=C(!1);const h=C(!1),S=C(["customer","company","customerCustom","estimate","estimateCustom"]);let i=ae(),N=se(),f=y(()=>e.isFetchingInitialSettings),U=y(()=>_.value?d("estimates.edit_estimate"):d("estimates.new_estimate")),_=y(()=>i.name==="estimates.edit");const D=y(()=>o.selectedCompanySettings.sales_tax_us_enabled==="YES"&&n.salesTaxUSEnabled),G={estimate_date:{required:b.withMessage(d("validation.required"),$)},estimate_number:{required:b.withMessage(d("validation.required"),$)},reference_number:{maxLength:b.withMessage(d("validation.price_maxlength"),ne(255))},customer_id:{required:b.withMessage(d("validation.required"),$)},exchange_rate:{required:oe(function(){return b.withMessage(d("validation.required"),$),e.showExchangeRate}),decimal:b.withMessage(d("validation.valid_exchange_rate"),ie)}},w=le(G,y(()=>e.newEstimate),{$scope:c});re(()=>e.newEstimate.customer,r=>{r&&r.currency?e.newEstimate.selectedCurrency=r.currency:e.newEstimate.selectedCurrency=o.selectedCompanyCurrency}),e.resetCurrentEstimate(),B.resetCustomFields(),w.value.$reset,e.fetchEstimateInitialSettings(_.value);async function H(){if(w.value.$touch(),w.value.$invalid)return!1;g.value=!0;let r=q(j({},e.newEstimate),{sub_total:e.getSubTotal,total:e.getTotal,tax:e.getTotalTax});const k=_.value?e.updateEstimate:e.addEstimate;try{let u=await k(r);u.data.data&&N.push(`/admin/estimates/${u.data.data.id}/view`)}catch(u){console.error(u)}g.value=!1}return(r,k)=>{const u=m("BaseBreadcrumbItem"),R=m("BaseBreadcrumb"),V=m("BaseButton"),z=m("router-link"),O=m("BaseIcon"),Y=m("BasePageHeader"),A=m("BaseScrollPane"),J=m("BasePage");return p(),P(ue,null,[s(fe),s(_e),s(he),t(D)&&(!t(f)||t(i).query.customer)?(p(),E(ve,{key:0,store:t(e),"store-prop":"newEstimate","is-edit":t(_),customer:t(e).newEstimate.customer},null,8,["store","is-edit","customer"])):I("",!0),s(J,{class:"relative estimate-create-page"},{default:l(()=>[v("form",{onSubmit:de(H,["prevent"])},[s(Y,{title:t(U)},{actions:l(()=>[r.$route.name==="estimates.edit"?(p(),E(z,{key:0,to:`/estimates/pdf/${t(e).newEstimate.unique_hash}`,target:"_blank"},{default:l(()=>[s(V,{class:"mr-3",variant:"primary-outline",type:"button"},{default:l(()=>[v("span",xe,M(r.$t("general.view_pdf")),1)]),_:1})]),_:1},8,["to"])):I("",!0),s(V,{loading:t(g),disabled:t(g),"content-loading":t(f),variant:"primary",type:"submit"},{left:l(K=>[t(g)?I("",!0):(p(),E(O,{key:0,class:T(K.class),name:"SaveIcon"},null,8,["class"]))]),default:l(()=>[me(" "+M(r.$t("estimates.save_estimate")),1)]),_:1},8,["loading","disabled","content-loading"])]),default:l(()=>[s(R,null,{default:l(()=>[s(u,{title:r.$t("general.home"),to:"/admin/dashboard"},null,8,["title"]),s(u,{title:r.$tc("estimates.estimate",2),to:"/admin/estimates"},null,8,["title"]),r.$route.name==="estimates.edit"?(p(),E(u,{key:0,title:r.$t("estimates.edit_estimate"),to:"#",active:""},null,8,["title"])):(p(),E(u,{key:1,title:r.$t("estimates.new_estimate"),to:"#",active:""},null,8,["title"]))]),_:1})]),_:1},8,["title"]),s(ke,{v:t(w),"is-loading":t(f),"is-edit":t(_)},null,8,["v","is-loading","is-edit"]),s(A,null,{default:l(()=>[s(be,{currency:t(e).newEstimate.selectedCurrency,"is-loading":t(f),"item-validation-scope":c,store:t(e),"store-prop":"newEstimate"},null,8,["currency","is-loading","store"]),v("div",Le,[v("div",je,[s(ye,{store:t(e),"store-prop":"newEstimate",fields:S.value,type:"Estimate"},null,8,["store","fields"]),s($e,{type:"Estimate","is-edit":t(_),"is-loading":t(f),store:t(e),"store-prop":"newEstimate","custom-field-scope":c,class:"mb-6"},null,8,["is-edit","is-loading","store"]),s(Ee,{store:t(e),"component-name":"EstimateTemplate","store-prop":"newEstimate","is-mark-as-default":h.value},null,8,["store","is-mark-as-default"])]),s(we,{currency:t(e).newEstimate.selectedCurrency,"is-loading":t(f),store:t(e),"store-prop":"newEstimate","tax-popup-type":"estimate"},null,8,["currency","is-loading","store"])])]),_:1})],40,Ve)]),_:1})],64)}}};export{Oe as default};