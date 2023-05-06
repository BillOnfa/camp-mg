window.addEventListener('load', function() {
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        document.querySelector('#loading').style.display = 'flex'
        setTimeout(function() {
            var select_date = document.querySelector('#exampleInputdate').value;
            $.ajax({
                url: 'get-data.php',
                type: 'POST',
                data: {
                    date: select_date,
                },
                dataType: 'json',
                success: function(data) {
                    // const customer_list = document.querySelector('#customerList')
                    // if(customer_list) customer_list.remove()

                    // const card_body = document.querySelector('.card-body')
                    // const new_customer_list = document.createElement('div')
                    // new_customer_list.classList.add('listjs-table')
                    // new_customer_list.id = 'customerList'
                    // card_body.appendChild(new_customer_list)

                    // const row_g4_mb3 = document.createElement('div')
                    // row_g4_mb3.classList.add('row', 'g-4', 'mb-3')
                    // new_customer_list.appendChild(row_g4_mb3)

                    // const col_sm = document.createElement('div')
                    // col_sm.classList.add('col-sm')
                    // row_g4_mb3.appendChild(col_sm)

                    // const dflex_justifycontentcontentsmend = document.createElement('div')
                    // dflex_justifycontentcontentsmend.classList.add('d-flex', 'justify-content-sm-end')
                    // col_sm.appendChild(dflex_justifycontentcontentsmend)

                    // const search_box = document.createElement('div')
                    // search_box.classList.add('search-box', 'ms-2')
                    // dflex_justifycontentcontentsmend.appendChild(search_box)

                    // const input_searchbox = document.createElement('input')
                    // input_searchbox.classList.add('form-control', 'search')
                    // input_searchbox.setAttribute('type', 'text')
                    // input_searchbox.setAttribute('placeholder', "Search...")
                    // search_box.appendChild(input_searchbox)
                    // const i_searchbox = document.createElement('i')
                    // i_searchbox.classList.add('ri-search-linem', 'search-icon')
                    // search_box.appendChild(i_searchbox)

                    // const table_responsive = document.createElement('div')
                    // table_responsive.classList.add('table-responsive', 'table-card', 'mt-3', 'mb-1')
                    // table_responsive.id = 'table_responsive'
                    // new_customer_list.appendChild(table_responsive)

                    // const customerTable = document.createElement('table')
                    // customerTable.classList.add('table', 'align-middle', 'table-nowrap')
                    // customerTable.id = 'customerTable'
                    // table_responsive.appendChild(customerTable)

                    // const thead_table = document.createElement('thead')
                    // thead_table.classList.add('table-light')
                    // customerTable.appendChild(thead_table)

                    // const tr_head = document.createElement('tr')
                    // thead_table.appendChild(tr_head)
                    
                    // const th1 = document.createElement('th')
                    // th1.setAttribute('scope', 'col')
                    // th1.style.width = '50px'
                    // tr_head.appendChild(th1)
                    // const div_input_form_check = document.createElement('div')
                    // div_input_form_check.classList.add('form-check')
                    // th1.appendChild(div_input_form_check)
                    // const input_checkbox = document.createElement('input')
                    // input_checkbox.setAttribute('type','checkbox')
                    // input_checkbox.classList.add('form-check-input')

                    // const th2 = document.createElement('th')
                    // th2.setAttribute('data-sort', 'customer_name')
                    // th2.classList.add('sort')
                    // th2.textContent = 'IP'
                    // tr_head.appendChild(th2)

                    // const th3 = document.createElement('th')
                    // th3.setAttribute('data-sort', 'email')
                    // th3.classList.add('sort')
                    // th3.textContent = 'Vị trí'
                    // tr_head.appendChild(th3)

                    // const th4 = document.createElement('th')
                    // th4.setAttribute('data-sort', 'phone')
                    // th4.classList.add('sort')
                    // th4.textContent = 'Ngày'
                    // tr_head.appendChild(th4)

                    // const th5 = document.createElement('th')
                    // th5.setAttribute('data-sort', 'date')
                    // th5.classList.add('sort')
                    // th5.textContent = 'Điện thoại'
                    // tr_head.appendChild(th5)

                    // const tbody_table = document.createElement('tbody')
                    // tbody_table.classList.add('list', 'form-check-all')
                    // customerTable.appendChild(tbody_table)
                    const customerTable = document.querySelector('#customerTable')
                    const tbody = document.querySelector('#customerTable tbody')
                    console.log(tbody);
                    if(tbody) tbody.remove()
                    const new_tbody = document.createElement('tbody')
                    new_tbody.classList.add('list', 'form-check-all')
                    customerTable.appendChild(new_tbody)
                    
                    data.forEach(function (item) {
                        const tr_body = document.createElement('tr')
                        new_tbody.appendChild(tr_body)
                        const th= document.createElement('th');
                        th.setAttribute('scope', 'row')
                        tr_body.appendChild(th);
                        const div = document.createElement('div');
                        div.classList.add('form-check')
                        th.appendChild(div);
                        const input = document.createElement('input');
                        input.classList.add('form-check-input')
                        input.setAttribute('type', 'checkbox')
                        div.appendChild(input);

                        const td1 = document.createElement('td');
                        td1.classList.add('customer_name')
                        td1.textContent = item.ip
                        tr_body.appendChild(td1)
                        const td2 = document.createElement('td')
                        td2.classList.add('email')
                        td2.textContent = item.location
                        tr_body.appendChild(td2)
                        const td3 = document.createElement('td')
                        td3.classList.add('phone')
                        td3.textContent = item.created_at
                        tr_body.appendChild(td3)
                        const td4 = document.createElement('td')
                        td4.classList.add('date')
                        td4.textContent = item.phone_number
                        tr_body.appendChild(td4)
                    })

                    // const div_result = document.createElement('div')
                    // div_result.classList.add('noresult')
                    // div_result.id = 'result'
                    // div_result.style.display = 'none'
                    // table_responsive.appendChild(div_result)

                    // const div_textcenter = document.createElement('div')
                    // div_textcenter.classList.add('text-center')
                    // div_result.appendChild(div_textcenter)

                    // const lord_icon = document.createElement('lord-icon')
                    // lord_icon.setAttribute('src','https://cdn.lordicon.com/msoeawqm.json')
                    // lord_icon.setAttribute('trigger', 'loop')
                    // lord_icon.setAttribute('colors', 'primary:#121331', 'secondary:#08a88a')
                    // lord_icon.style.width = '75px'
                    // lord_icon.style.height = '75px'
                    // div_textcenter.appendChild(lord_icon)

                    // const h5_result = document.createElement('h5')
                    // h5_result.classList.add('mt-2')
                    // h5_result.textContent = 'Sorry! No Result Found'
                    // div_textcenter.appendChild(h5_result)

                    // const p_result = document.createElement('p')
                    // p_result.classList.add('mt-2')
                    // p_result.textContent = "We've searched more than 150+ Orders We did not find any orders for you search."
                    // div_textcenter.appendChild(p_result)

                    // const find_data = document.createElement('div')
                    // find_data.classList.add('d-flex', 'justify-content-end')
                    // find_data.id = 'find_data'
                    // new_customer_list.appendChild(find_data)

                    // const hstack = document.createElement('div')
                    // hstack.classList.add('pagination-wrap', 'hstack', 'gap-2')
                    // find_data.appendChild(hstack)

                    // const prev = document.createElement('a')
                    // prev.classList.add('page-item', 'pagination-prev', 'disable')
                    // prev.innerHTML = 'Previous'
                    // hstack.appendChild(prev)

                    // const ul_hstack = document.createElement('ul')
                    // ul_hstack.classList.add('pagination', 'listjs-pagination', 'mb-0')
                    // hstack.appendChild(ul_hstack)

                    // const li1_stack = document.createElement('li')
                    // li1_stack.classList.add('active')
                    // hstack.appendChild(li1_stack)
                    // const a_li1 = document.createElement('a')
                    // a_li1.classList.add('page')
                    // a_li1.setAttribute('data-i', '1')
                    // a_li1.setAttribute('data-page', '8')
                    // a_li1.innerHTML = '1'
                    // li1_stack.appendChild(a_li1)

                    // const li2_stack = document.createElement('li')
                    // li2_stack.classList.add('active')
                    // hstack.appendChild(li2_stack)
                    // const a_li2 = document.createElement('a')
                    // a_li2.classList.add('page')
                    // a_li2.setAttribute('data-i', '2')
                    // a_li2.setAttribute('data-page', '8')
                    // a_li2.innerHTML = '2'
                    // li2_stack.appendChild(a_li2)
                    
                    // const li3_stack = document.createElement('li')
                    // li3_stack.classList.add('active')
                    // hstack.appendChild(li3_stack)
                    // const a_li3 = document.createElement('a')
                    // a_li3.classList.add('page')
                    // a_li3.setAttribute('data-i', '3')
                    // a_li3.setAttribute('data-page', '8')
                    // a_li3.innerHTML = '3'
                    // li3_stack.appendChild(a_li3)

                    // const next = document.createElement('a')
                    // next.classList.add('page-item', 'pagination-next')
                    // next.innerHTML = 'Next'
                    // hstack.appendChild(next)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })
            
        document.querySelector('#loading').style.display = 'none'
        }, 1000);
    })
})