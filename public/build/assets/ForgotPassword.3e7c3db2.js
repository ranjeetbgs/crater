var j=Object.defineProperty,C=Object.defineProperties;var M=Object.getOwnPropertyDescriptors;var h=Object.getOwnPropertySymbols;var N=Object.prototype.hasOwnProperty,D=Object.prototype.propertyIsEnumerable;var B=(a,e,t)=>e in a?j(a,e,{enumerable:!0,configurable:!0,writable:!0,value:t}):a[e]=t,$=(a,e)=>{for(var t in e||(e={}))N.call(e,t)&&B(a,t,e[t]);if(h)for(var t of h(e))D.call(e,t)&&B(a,t,e[t]);return a},y=(a,e)=>C(a,M(e));import{C as E,z as G,a0 as L,B as b,k as P,E as k,H as z,L as A,O as F,r as u,o as c,e as p,f as m,w as v,u as r,t as _,h as H,i as O,P as R}from"./vendor.5f3776de.js";import{u as T}from"./auth.f88d221e.js";import"./main.d106ea19.js";const U=["onSubmit"],J={key:0},K={key:1},Q={class:"mt-4 mb-4 text-sm"},ee={setup(a){const e=T(),{t}=E(),S=G(),l=L({email:"",company:""}),f=b(!1),n=b(!1),V=P(()=>({email:{required:k.withMessage(t("validation.required"),z),email:k.withMessage(t("validation.email_incorrect"),A)}})),o=F(V,l);function w(i){if(o.value.$touch(),o.value.$invalid)return!0;n.value=!0;let s=y($({},l),{company:S.params.company});e.forgotPassword(s).then(d=>{n.value=!1}).catch(d=>{n.value=!1}),f.value=!0}return(i,s)=>{const d=u("BaseInput"),I=u("BaseInputGroup"),q=u("BaseButton"),x=u("router-link");return c(),p("form",{id:"loginForm",onSubmit:R(w,["prevent"])},[m(I,{error:r(o).email.$error&&r(o).email.$errors[0].$message,label:i.$t("login.enter_email"),class:"mb-4",required:""},{default:v(()=>[m(d,{modelValue:r(l).email,"onUpdate:modelValue":s[0]||(s[0]=g=>r(l).email=g),type:"email",name:"email",invalid:r(o).email.$error,onInput:s[1]||(s[1]=g=>r(o).email.$touch())},null,8,["modelValue","invalid"])]),_:1},8,["error","label"]),m(q,{loading:n.value,disabled:n.value,type:"submit",variant:"primary"},{default:v(()=>[f.value?(c(),p("div",K,_(i.$t("validation.not_yet")),1)):(c(),p("div",J,_(i.$t("validation.send_reset_link")),1))]),_:1},8,["loading","disabled"]),H("div",Q,[m(x,{to:"login",class:"text-sm text-primary-400 hover:text-gray-700"},{default:v(()=>[O(_(i.$t("general.back_to_login")),1)]),_:1})])],40,U)}}};export{ee as default};