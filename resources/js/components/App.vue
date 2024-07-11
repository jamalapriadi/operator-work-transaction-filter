<template>
    <div>
        <div class="card">
            <div class="card-header">Operator Work Transaction</div>
            <div class="card-body border-bottom py-3">
                <div class="row mb-3">
                    <div class="col-lg-2 col-12"></div>
                    <div class="col-lg-2 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Mesin ID</label>
                            <select v-model="form.mesin" name="mesin_id" id="mesin_id" class="form-select" @change="filterData">
                                <option value="" disabled>--Select Mesin--</option>
                                <option v-for="(l,idx) in mesins" :key="idx" :value="l">{{ l }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Month</label>
                            <input type="month" v-model="form.month" class="form-control" @input="inputMonth($event)">
                        </div>
                    </div>

                    <div class="col-lg-2 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Site</label>
                            <select v-model="form.site" name="site" id="site" class="form-select" @change="filterData">
                                <option value="" disabled>--Select Site--</option>
                                <option v-for="(l,idx) in sites" :key="idx" :value="l">{{ l }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Operator</label>
                            <select v-model="form.operator" name="operator" id="operator" class="form-select" @change="filterData">
                                <option value="" disabled>--Select Operator--</option>
                                <option v-for="(l,idx) in operators" :key="idx" :value="l">{{ l }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 col-12">
                        <div class="mb-3">
                            <label for="" class="form-label">Activity</label>
                            <select v-model="form.activity" name="activity" id="activity" class="form-select" @change="filterData">
                                <option value="" disabled>--Select Operator--</option>
                                <option v-for="(l,idx) in activities" :key="idx" :value="l">{{ l }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex mb-3">
                    <div class="text-muted">
                        Show
                        <div class="mx-2 d-inline-block">
                            <select class="form-select" v-model="per_page" @change="loadPerPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        entries
                    </div>
                    <div class="ms-auto text-muted">
                        Search:
                        <div class="ms-2 d-inline-block">
                            <input type="text" class="form-control" @input="filterInput($event)">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Submitted By</th>
                                <th>Submitted When</th>
                                <th>Site Code</th>
                                <th>Activity</th>
                                <th>UOM</th>
                                <th>Block</th>
                                <th>Task</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Mesin ID</th>
                                <th>Fuel</th>
                                <th>Check By</th>
                                <th>When Check</th>
                                <th>Verified By</th>
                                <th>When Verified</th>
                                <th>Duty</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody v-if="lists && lists.data">
                            <tr v-for="(l,idx) in lists.data">
                                <td>
                                    <a href="#" class="btn btn-primary">Edit</a>
                                </td>
                                <td>{{ l.submitted_by }}</td>
                                <td>{{ l.submitted_when }}</td>
                                <td>{{ l.site_code }}</td>
                                <td>{{ l.activity }}</td>
                                <td>{{ l.uom }}</td>
                                <td>{{ l.block }}</td>
                                <td>{{ l.task }}</td>
                                <td>{{ l.start }}</td>
                                <td>{{ l.end }}</td>
                                <td>{{ l.mesin_id }}</td>
                                <td>{{ l.fuel }}</td>
                                <td>{{ l.check_by }}</td>
                                <td>{{ l.when_check }}</td>
                                <td>{{ l.verified_by }}</td>
                                <td>{{ l.when_verified }}</td>
                                <td>{{ l.duty }}</td>
                                <td>{{ l.reason }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-flex align-items-center" v-if="meta">
                <p v-if="meta.pagination" class="m-0 text-muted">Showing <span>{{ meta.pagination.count }}</span> to <span>{{ meta.pagination.current_page }}</span> of <span>{{ meta.pagination.total_pages }}</span> entries</p>
                <paginate v-if="meta.pagination"
                    :page-count="meta.pagination.total_pages"
                    :page-range="3"
                    :margin-pages="2"
                    :click-handler="clickCallback"
                    :prev-text="'Prev'"
                    :next-text="'Next'"
                    :container-class="'pagination m-0 ms-auto'"
                    :page-class="'page-item'"
                >
                </paginate>
            </div>
        </div>
    </div>
</template>


<script>
import Paginate from 'vuejs-paginate-next';
export default{
    components: {
      paginate: Paginate,
    },
    data(){
        return {
            lists:[],
            meta:{
                total: null,
                current_page: null,
                per_page: null,
                from: null,
                to: null
            },
            current_page:1,
            per_page:10,
            search:'',
            sortBy:'created_at',
            sortByDesc:false,
            mesins:[],
            sites:[],
            operators:[],
            activities:[],
            form:{
                mesin:'',
                site:'',
                operator:'',
                activity:'',
                month:''
            }
        }
    },
    mounted(){
        this.getFilters()
        this.getData()
    },
    methods:{
        getFilters(){
            axios.get('/data/list-filters')
                .then(resp => {
                    this.mesins = resp.data.mesins
                    this.sites = resp.data.sites
                    this.operators = resp.data.operators
                    this.activities = resp.data.activities
                })
        },

        getData(){
            var params={
                per_page: this.per_page,
                page: this.current_page,
                q: this.search,
                sortby: this.sortBy,
                sortbydesc: this.sortByDesc ? 'DESC':'ASC',
                mesin: this.form.mesin,
                site: this.form.site,
                activity: this.form.activity,
                operator: this.form.operator,
                month: this.form.month
            }

            axios.get('/data/operator-work', {params})
                .then(resp => {
                    this.lists = resp.data

                    if(resp.data.meta)
                    {
                        this.meta = resp.data.meta
                    }
                })
        },

        clickCallback (pageNum){
            this.current_page = pageNum
            this.getData()
        },

        loadPerPage(){
            this.getData()
        },

        filterInput(e){
            clearTimeout(this.timer)

            this.timer = setTimeout(() => {
                this.search = e.target.value 
                this.getData()
            }, 500)
        },

        filterData(){
            this.getData()
        },

        inputMonth(e){
            this.form.month = e.target.value 
            this.getData()
        }
    }
}
</script>