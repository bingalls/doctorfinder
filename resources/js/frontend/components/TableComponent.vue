<template>
    <v-card>
        <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="doctors"
            :search="search"
        ></v-data-table>
    </v-card>
</template>

<script>
export default {
    data () {
        return {
            totalDoctors: 0,
            doctors: [],
            loading: true,
            options: {sortBy:null, sortDesc:null, page:null, itemsPerPage:null},
            search: '',
            headers: [
                { text: 'First Name', value: 'Physician_Profile_Last_Name', },
                { text: 'Last Name', value: 'Physician_Profile_First_Name', },
                { text: 'Specialty', value: 'Physician_Profile_Primary_Specialty', },
                { text: 'City', value: 'Physician_Profile_City', },
                { text: 'State', value: 'Physician_Profile_State', },
                { text: 'Zip', value: 'Physician_Profile_Zipcode', },
            ],
        }
    },
    watch: {
        options: {
            handler () {
                this.getDataFromApi();
            },
            deep: true,
        },
    },
    mounted () {
        this.getDataFromApi()
    },
    methods: {
        getDataFromApi () {
            this.loading = true;
            this.apiCall().then(data => {
                this.doctors = data?.items
                this.totalDoctors = data?.total
                this.loading = false
            })
        },
        async apiCall () {
            return await axios.get(window.location.origin + '/api/search/')
                .then(function (response) {
                    const { sortBy, sortDesc, page, itemsPerPage } =
                        this?.options ? this.options : {sortBy:null, sortDesc:null, page:null, itemsPerPage:null};
                    const total = response.data.length;
                    if (sortBy?.length === 1 && sortDesc?.length === 1) {
                        response.data = response.data.sort((a, b) => {
                            const sortA = a[sortBy[0]]
                            const sortB = b[sortBy[0]]

                            if (sortDesc[0]) {
                                if (sortA < sortB) return 1
                                if (sortA > sortB) return -1
                                return 0
                            } else {
                                if (sortA < sortB) return -1
                                if (sortA > sortB) return 1
                                return 0
                            }
                        })
                    }
                    if (itemsPerPage > 0) {
                        response.data = response.data.slice((page - 1) * itemsPerPage, page * itemsPerPage)
                    }
                    return({items: response.data, total});
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
}
</script>
