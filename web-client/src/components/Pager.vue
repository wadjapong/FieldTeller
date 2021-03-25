<template>
    <div>
      <table class="table ">
          <thead>
              <tr>
                  <th>
                      <label>
                          Show
                          <select v-model="divisor" @change="index=0">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                          </select>
                          Entries
                      </label>
                  </th>
                  <th>
                      <input type="text" v-model="searchKey" class="form-control" placeholder="Search">
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td colspan="2">
                    <slot name="pagertable" :propdata="searchQuery"></slot>
                  </td>
              </tr>
          </tbody>
          
          <tfoot>
              <tr>
                  <td class="pagination pull-left">Showing {{this.start + 1}} &rarr; <span v-if="this.limit < this.dataLength">{{this.limit}}</span><span v-else>{{this.dataLength}}</span> of {{this.dataLength}} Entries</td>
                  <td>
                        <ul class="pagination">
                          <li v-if="index > 0" class="btn btn-primary" @click="prev" >Prev</li>
                          <li v-else class="btn btn-primary" disabled >Prev</li>
                          <li v-if="index > 3">...</li>
                          <li v-for="(v,i) in pagerData" @click="setActive(i)" :key="i"  :class="{'active':index==i, 'hidden':(i>3 && index < i) || i < index-3}" class="btn btn-primary">{{i+1}}</li>
                          <!-- <li v-if="pagerData.length > 3">...</li> -->
                          <li v-if="index < pagerData.length -1" class="btn btn-primary" @click="next">Next</li>
                          <li v-else class="btn btn-primary" disabled>Next</li>
                      </ul>
                  </td>
              </tr>
          </tfoot>
      </table>
        
    </div>
</template>

<script>
/* eslint-disable */
export default {
  name: 'pager',
  props: {
    tableData: {
      type: Array,
      required: true
    },
    searchFunction: {
      type: Function,
      default: (function(){var x = function(x=2,y=3){return this.filteredData};return x})()
    }
  },
  /* eslint-enable */
  data () {
    return {
      msg: 'Hello Vue!',
      index: 0,
      divisor: 10,
      paginationDisplayLength: 0,
      searchKey: '',
      hasFilterFunction: false,
      searchedData: []
    }
  },
  mounted () {
  },

  methods: {
    setActive(index) {
        this.index = index
    },
    next () {
      this.index ++
    },
    prev () {
      if (this.index < 1) {
        return
      }
      this.index --
    },
    searchFilteredData (input) {
      this.searchedData = this.searchFunction(this.filteredData,input)
    },
  },
  created () {
  },
  computed: {
    searchQuery () {
      return this.searchFunction(this.filteredData,this.searchKey)
    },
    filteredData () {
      var dataset = []
      if (this.pagerData.length-1 == this.index && this.remainder > 0){
        var lastIndex = (this.quotient * this.divisor)
        for(var i = 0; i < this.remainder; i++){
          dataset.push(this.tableData[lastIndex+i])
        }
      }else{
        for(var i2 = this.start; i2 < this.limit; i2++){
          dataset.push(this.tableData[i])
        }
      }
      return dataset
    },
    dataLength () {
      return this.tableData.length
    },
    quotient () {
      return parseInt(this.dataLength/this.divisor)
    },
    pagerData () {
      var pager = []
      for (var i = 0; i < this.quotient; i++){
        pager.push(i)
      }
      if(this.remainder > 0){
        pager.push(this.quotient)
      }
      return pager
    },
    remainder () {
      return this.dataLength % this.divisor 
    },
    limit () {
      return parseInt((this.index + 1) * this.divisor)
    },
    start () {
      return parseInt(this.limit - this.divisor)
    }
  }
}

</script>

<style scoped>
    .hidden {
      display: none
    }
    .pagination {
        float: right;
    }
    .pagination li {
        list-style-type: none;
        display: inline;
    }
    .pagination li.active {
        background: teal;
        color: white!important
    }
    .checkbox+.checkbox,.radio+.radio
    {
        margin: 0;
    }

    /* .search_params {
        display: flex;
    } */

    .option__image{
        height: 60px;
        width: 60px;
        border-radius: 30px;
        display: inline-flex;
        margin-right: 10px;
        float: left;
    }
    .option__desc{
        padding-top: 10px
    }

    .option__small {
        text-align: left
    }
    .widget-user-2 .widget-user-image>img {
        float: left;
        margin-top: -10px;
        margin-left: -10px;
        border-radius: 60px;
        width: 80px;
        height: 80px;
    }
</style>
