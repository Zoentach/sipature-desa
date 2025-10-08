document.addEventListener("DOMContentLoaded",()=>{const s=document.getElementById("search-desa"),e=document.getElementById("search-results");!s||!e||(s.addEventListener("input",function(){const n=this.value;if(n.length<2){e.classList.add("hidden"),e.innerHTML="";return}fetch(`/search?query=${encodeURIComponent(n)}`).then(t=>t.json()).then(t=>{if(t.length>0){let d=t.map(a=>{var i;const c=((i=a.kepala_desa)==null?void 0:i.nama)??"-";return`
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                                onclick="window.location.href='/detail-desa/${a.id}'">
                                <div class="font-medium">${a.nama}</div>
                                <div class="text-sm text-gray-500">
                                  <!--  Kecamatan: ${a.kode_kecamatan} <br> -->
                                    Kepala Desa: ${c}
                                </div>
                            </li>`}).join("");e.innerHTML=d,e.classList.remove("hidden")}else e.innerHTML='<li class="px-4 py-2 text-gray-500">Tidak ditemukan</li>',e.classList.remove("hidden")})}),document.addEventListener("click",function(n){!s.contains(n.target)&&!e.contains(n.target)&&e.classList.add("hidden")}))});
