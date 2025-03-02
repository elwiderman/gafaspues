
import ready from 'domready';
import $ from 'jquery';
import DataTable from 'datatables.net-dt';
import language from 'datatables.net-plugins/i18n/es-ES.mjs';


export default class AdminPages {
    constructor() {
        this.init();
    }
    
    init() {
        this.vendorOrdersList();
        this.vendorUpdateOrderStatus();
    }
    
    // list of orders for vendor
    vendorOrdersList() {        
        let table = new DataTable('#ordersDataTable', {
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: `${wpurls.vendor_orders}`,
                type: 'POST'
            },
            columns: [
                {
                    title: '#',
                    data: 'id'
                }, {
                    title: 'Cliente',
                    data: 'name'
                }, {
                    title: 'Superior',
                    data: 'parent'
                }, {
                    title: 'Total',
                    data: 'total'
                }, {
                    title: 'Comisión',
                    data: 'commission'
                }, {
                    title: 'Fecha',
                    data: 'date'
                }, {
                    title: 'Estado',
                    data: 'status'
                }, {
                    title: '',
                    data: 'action'
                }
            ],
            order: [[0, 'desc']],
            columnDefs: [{
                targets: [0, 3, 5, 6],
                orderable: true
            }, {
                orderable: false,
                targets: '_all'
            }],
            lengthMenu: [[25, 50, -1], [25, 50, 'Todo']],
            language
        });
    }

    // let the vendor update the order status for their orders
    vendorUpdateOrderStatus() {
        let form = $('#vendorUpdateOrderStatus');

        form.on('submit', e => {
            e.preventDefault();

            let formdata = form.serializeArray();

            $.ajax({
                data: formdata,
                type: 'post',
                dataType: 'json',
                url: wpurls.ajaxurl,
                beforeSend: xhr => {
                    console.log('loading ...');
                    // console.log(formdata);
                    form.find('button').addClass('loading');
                    form.find('p.response').remove();
                },
                success: response => {
                    // console.log(response);
                    if (response.success) {
                        form.append(`<p class='response text-success mt-3'>${response.data.message}</p>`)
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        form.append(`<p class='response text-danger mt-3'>${response.data.message}</p>`)
                        form.find('button').removeClass('loading');
                    }
                },
                error: err => {
                    console.log(err);
                    form.find('button').removeClass('loading');
                    
                }
            });
            

            return false;
        });
    }
}

ready(() => {
    new AdminPages();
});