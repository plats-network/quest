import{j as t,r as s,U as c,A as i,P as l}from"./deposit-ce893b1a.js";import{c as u}from"./contract-metadata-fa83a96e.js";import{M as m}from"./ModalWallet-7b30bda6.js";import"./axios-82afda87.js";function d(){const[o,e]=s.useState(!1),[p,r]=s.useState(),a=()=>{e(!0)};return t.jsxs(c,{config:{dappName:"hkt_plats",chains:[i,l]},children:[t.jsxs("a",{href:"#",onClick:a,className:"btn btn-sm btn-gray-800 d-inline-flex align-items-center",children:[t.jsx("svg",{class:"icon icon-xs me-2",fill:"none",stroke:"currentColor",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg",children:t.jsx("path",{strokeLinecap:"round",strokeLinejoin:"round",strokeWidth:"2",d:"M12 6v6m0 0v6m0-6h6m-6 0H6"})}),"New Quest"]}),o&&t.jsx(m,{setIsModal:e,setAccount:r})]})}const n=u(document.getElementById("new_quest_button"));n!==null&&n.render(t.jsx(d,{}));
