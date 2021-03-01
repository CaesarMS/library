<template>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <img id="stendard" src="img/stendard.png" />
                <button type="button" class="btn mt-3"> <span class="mr-1" style="color: #52C41A">+</span> Add</button>
            </div>
            <div id="tree" v-if="componentLoaded"> </div>
        </nav>
        

        <!-- Page Content -->
        <div id="content">
            <nav :class="{sidebarShadow: showFilter ? true : false }"> </nav>
            <div id="topNav">
                <form method="" id="search" class="pt-1">
                    <input name="q" type="text" size="40" placeholder="Search solution..." />
                </form>
            </div>
            <div class="wrapperContent">
                 
                <input id="slide-sidebar" type="checkbox" role="button" />
                <label for="slide-sidebar" class="text-center" :class="{showDetails:showDetails,hideDetails:hideDetails}" @click="showing()" id="detailLabel"> 
                    <img src="img/arrow.png" style="width: 8px; margin-top: 2vh" :class="{mirror:mirror}">
                </label>
                <transition name="list"> <nav id="shadow" v-show="showFilter"> </nav> </transition>
                
                <nav id="rightbar">
                    <div class="sidebar-header text-center p-2">
                        <h5>Details</h5>
                    </div>
                    <div class="p-4" v-if="folder">
                        <h6>Name</h6>
                        <span>{{ name }}</span>
                        <h6 class="mt-4">File Type</h6>
                        <span>Folder</span>
                        <h6 class="mt-4">Created</h6>
                        <span>{{ createFolder }}</span>
                    </div>
                    <div class="p-4" v-if="file">
                        <h6>Name</h6>
                        <span>{{ name }}</span>
                        <h6 class="mt-4">File Type</h6>
                        <span>{{ type }}</span>
                        <h6 class="mt-4">Size</h6>
                        <span>{{ size }}</span>
                        <h6 class="mt-4">Last Updated</h6>
                        <span>{{ lastUpdated }}</span>
                        <h6 class="mt-4">Status</h6>
                        <span>{{ status }}</span>
                    </div>
                    <div class="p-4" v-if="thing">
                        <h6>Target is Null</h6>
                    </div>
                </nav>
                <label class="text-center" id="filterLabel" @click="show()">
                    <div style="margin-top: 0.8vh" :class="{clicked:clicked}">
                        <img src="img/filter.png" style="width: 15px;">
                        <span>Filter</span>
                    </div>
                </label>    
                <div id="filter">
                    <form method="" style="margin-top: 10vh; margin-left: 30px;" >
                        <div class="rowM">
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-weight: bold;">Document Type</label></div>
                                <select style="width: 250px;" class="filterForm">
                                    <option value="">Manual, procedure, project, etc.</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-weight: bold;">Format</label></div>
                                <select style="width: 250px;" class="filterForm">
                                    <option value="">pdf, doc, or xls</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-weight: bold;">Author</label></div>
                                <select style="width: 250px;" class="filterForm">
                                    <option value="">-</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-weight: bold;">Department</label></div>
                                <select style="width: 250px;" class="filterForm">
                                    <option value="">Select Department</option>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="rowM">
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-weight: bold;">Select Category</label></div>
                                <select style="width: 250px;" class="filterForm">
                                    <option value="">Select Category</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mr-2">
                                <div><label for="" style="color: #000000; font-weight: bold;">File Status</label></div>
                                <select style="width: 250px;" class="filterForm">
                                    <option value="">Draft, published, authorized, etc.</option>
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="columnM mt-2">
                                <button @click="show()" type="button" class="btnX mt-4 mr-2" style="width: 80px; background-color: #1890FF; color: #FFFFFF;"><i class="fa fa-times mr-2"></i>Close</button>
                                <button type="button" class="btnX mt-4" style="width: 120px; background-color: #FAFAFA; color: #1890FF"><i class="fa fa-history mr-2"></i>Reset Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div ref="box" :class="{showDetails:showDetails,hideDetails:hideDetails,showFilter:showFilter,hideFilter:hideFilter}" class="demo-gallery" @click="clear()" @contextmenu="clear()">
                    <div class="move" :style="{top:topM, left:leftM}" ref="hehe" v-if="xx">
                        <div class="mt-3">
                            <div class="rowM">
                                <div class="columnM">
                                    <img :src="pictToMove" style="width: 30px;">
                                </div>
                                <div class="columnM">
                                    <span>{{ fileToMove }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul id="right-click-menu" tabindex="-1" ref="rightMenu" v-if="viewMenu" :style="{top:top, left:left}" class="fa-ul">
                        <li><i class="fa-li fa fa-eye"></i>Preview</li>
                        <li style="color: #078F0C"><i class="fa-li fa fa-edit"></i>Live Edit</li>
                        <li><i class="fa-li fa fa-file"></i>Edit in Word 365</li>
                        <li><i class="fa-li fa fa-italic"></i>Rename</li>
                        <li><i class="fa-li fa fa-link"></i>Copy Link</li>
                        <li><i class="fa-li fa fa-arrows-alt"></i>Move File</li>
                        <li><i class="fa-li fa fa-list-ol"></i>Start Version Control</li>
                        <li><i class="fa-li fa fa-exchange"></i>See Workflow</li>
                        <li style="border-bottom: 1px solid #E0E0E0;"><i class="fa-li fa fa-share-alt"></i>Share</li>
                        <li><i class="fa-li fa fa-info"></i>Document Info</li>
                        <li style="border-bottom: 1px solid #E0E0E0;"><i class="fa-li fa fa-download"></i>Download</li>
                        <li style="color: #E70000"><i class="fa-li fa fa-trash"></i>Delete</li>
                    </ul>
                    
                    <h5 style="margin-top: 6vh; position: absolute;">Recent Files</h5>
                    <ul id="lightgallery" class="list-unstyled row" v-if="contentLoaded">
                        <li v-for="(file, index) in getFiles" :key="index" class="col-xs-6 col-sm-4 col-md-2 col-lg-2 text-center">
                            <a href="" @click.stop.prevent="getDetails(file.id)" :class="active(file.id)" :draggable="true"
                            @dragstart="startDrag($event, file.id)" @contextmenu.stop="openMenu($event, file.id)" @dragend="stopDrag()" @drag="dragging($event)">
                                <img class="img-responsive" :src="getImg(file.id)">
                                <div>
                                    <span :draggable="true" @dragstart="startDrag($event, folder.id)" @drag="dragging($event)">{{ file.file.length>10 ? file.file.slice(0, 10).concat('...') : file.file }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <h5 style="position: absolute;">Folders</h5>
                    <ul style="margin-top: 4vh;" class="list-unstyled row" v-if="contentLoaded">
                        <li v-for="(folder, index) in getFolders" :key="index" class="col-xs-6 col-sm-4 col-md-2 col-lg-2 text-center">
                            <a href="" @click.stop.prevent="getDetails(folder.id)" :class="active(folder.id)" :draggable="false" @drop="onDrop($event, folder.file)"
                            @dragover="$event.preventDefault()" @dragenter="$event.preventDefault()" @contextmenu.stop="openMenu($event, folder.id)" @dragend="stopDrag()" @drag="dragging($event)">
                                <img class="img-responsive" :src="getImg(folder.id)" :draggable="folder.type == 'file' ? true : false" @dragstart="folder.type == 'file' ? startDrag($event, folder.id) : ''" @drag="dragging($event)">
                                <div>
                                    <span :draggable="folder.type == 'file' ? true : false" @dragstart="folder.type == 'file' ? startDrag($event, folder.id) : ''" @drag="dragging($event)">{{ folder.file.length>10 ? folder.file.slice(0, 10).concat('...') : folder.file }}</span>
                                </div>
                            </a>
                        </li>
                    </ul>

                    <table id="example" border="0" style="width:100%" v-if="contentLoaded">
                        <thead style="border-bottom: 1px solid #BBBBBB !important;">
                            <tr>
                                <th style="width: 50%">Name</th>
                                <th style="width: 10%">Doc No</th>
                                <th style="width: 10%">Size</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Upload Date</th>
                                <th style="width: 10%">Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(file, index) in getFiles" :key="index" @click.stop.prevent="getDetails(file.id)" :class="active(file.id)" :draggable="true"
                            @dragstart="startDrag($event, file.id)" @contextmenu.stop="openMenu($event, file.id)" @dragend="stopDrag()" @drag="dragging($event)">
                                <td><img class="mr-2" :src="getImg(file.id)" style="width: 30px;">{{file.file}}</td>
                                <td>{{ file.doc_no }}</td>
                                <td>{{file.size}}</td>
                                <td>{{file.file_status}}</td>
                                <td>{{file.file_last_updated}}</td>
                                <td>{{file.last_updated}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-secondary alert-dismissible fade show" role="alert" v-if="alert">
                    <div class="mt-3">
                        <div>Successfully move the file to</div>
                        <div class="rowM">
                            <div class="columnM">
                                <img src="img/folder.png" style="width: 30px;">
                            </div>
                            <div class="columnM">
                                <span>{{ folderMove }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="clear()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                            
            </div>
            
            
            <!-- <router-view></router-view> -->
        </div>

    </div>       
</template>

<script>
    export default {
        data() {
            return {
                folderMove: '',
                componentLoaded: false,
                contentLoaded: false,
                fileContent: null,
                children:[],
                content:null,
                name: '',
                createFolder:'',
                type:'',
                size:'',
                lastUpdated:'',
                status:'',
                folder: false,
                file: false,
                thing: true,
                showDetails: false,
                hideDetails: true,
                showFilter: false,
                hideFilter: true,
                clicked: false,
                aRow: [],
                drag:[],
                drop:[],
                mirror: false,
                alert: false,
                viewMenu: false,
                top: '0px',
                left: '0px',
                topM: '0px',
                leftM: '0px',
                xx: false,
                fileToMove: '',
                pictToMove: ''
            }
        },
        created: function(){
            this.getLibrary;
            this.getContent;
            
        },
        mounted: function(){
            // window.addEventListener('mouseup', this.stopDrag);
        },
        beforeUpdate: function(){
            let $vm = this;
            $(function () {
                var json;
                
                console.log('xx = ', json = $vm.children);
                console.log('arow = ', $vm.aRow);
                
                console.log('bool = ', $vm.componentLoaded);
                console.log('c2 = ', $vm.content);
                console.log('content = ', $vm.fileContent);


                $('#tree').bstreeview({
                    data: JSON.stringify(json),
                    xpandIcon:'fa fa-angle-down',
                    collapseIcon:'fa fa-angle-right'
                });

            });
            // $(document).ready(function() {
            //     $('#example').DataTable();
            // } );
        },
        computed:{
            getFiles: function() {
                return this.content.filter(function(u) {
                    return u.type === 'file';
                })
            },
            getFolders: function() {
                return this.content.filter(function(u) {
                    return u.type === 'folder';
                })
            },
            getLibrary: function(){
                var self = this;
                let child;

                self.children.push.apply(self.children, [{
                    text: "Ahyar Ahfal Imanudin",
                    icon: "fa fa-user",
                    nodes: [{
                        text: "Profile",
                        icon: "fa fa-id-card",
                        click: "www.google.com"
                    }]
                },{
                    text: "Document Generator",
                    icon: "fa fa-object-group"
                },{
                    text: "Library",
                    icon: "fa fa-folder"
                },{
                    text: "Workflow",
                    icon: "fa fa-exchange"
                },{
                    text: "Help",
                    icon: "fa fa-info-circle"
                },{
                    text: "Audit Trail",
                    icon: "fa fa-list-ol"
                },{
                    text: "Changelog",
                    icon: "fa fa-history",
                    href: "www.google.com"
                }]);
                self.children[2].nodes=[];
                axios.get("/folder_tree_left_side_bar.json")    
                    .then(function(response){  
                        self.fileContent = response.data;
                        for(let i=0; i<self.fileContent.length; i++){
                            child = {
                                text: self.fileContent[i].text,
                                icon: "fa fa-folder"
                            }

                            if(self.fileContent[i].children.length > 0){
                                child.nodes = []
                                for(let j=0; j<self.fileContent[i].children.length; j++){
                                    child.nodes.push({
                                        text: self.fileContent[i].children[j].text,
                                        icon: "fa fa-folder",
                                    })
                                }
                                
                            }
                            self.children[2].nodes.push(child);
                        }

                    })
                    .then(function(){
                        self.componentLoaded = true;
                    })               
                    .catch(function(err){
                        console.log(err.response);
                    });
            },
            getContent: function(){
                var self = this;

                axios.get("/default_library.json")    
                    .then(function(response){  
                        self.content = response.data;
                        for(let i=0; i<self.content.length; i++){
                            self.aRow.push({'row':false});
                            if(self.content.type == 'folder'){
                                self.drop.push('drop'+i);
                            }else{
                                self.drag.push('drag'+i);
                            }
                        }
                    })
                    .then(function(){
                        self.contentLoaded = true;
                        // console.log(self.content);
                    })               
                    .catch(function(err){
                        console.log(err.response);
                    });
            }
        },
        methods:{
            stopDrag: function(){
                console.log('xx = ', this.xx=false);
                this.fileToMove = '';
                this.pictToMove = '';
                // Vue.nextTick(function() {
                    

                    this.topM = '0px';
                    this.leftM = '0px';
                   
                // }.bind(this));
                console.log('tM & lM = ', this.topM, this.leftM);
            },
            movee: function(e){
                
                    Vue.nextTick(function() {
                        if(this.xx){
                            let t = e.offsetY;
                            let l = e.offsetX;

                            console.log('tM = ', t);
                            console.log('lM = ', l);

                            this.topM = t + 'px';
                            this.leftM = l + 'px';
                        }
                    }.bind(this));
                
            },
            check: function(e){
                if(this.xx){
                    Vue.nextTick(function() {
                        let t = e.y-625;
                        let l = e.x-250;

                        console.log('tM = ', t);
                        console.log('lM = ', l);

                        this.topM = t + 'px';
                        this.leftM = l + 'px';
                    }.bind(this));
                }
            },
            setMenu: function(top, left) {
                let t = top-60;
                let l = left-250;


                console.log('t = ', t);
                console.log('l = ', l);


                this.top = t + 'px';
                this.left = l + 'px';
            },

            openMenu: function(e, idd) {
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.alert = false;
                this.folderMove = '';
                this.mirror = true;
                this.aRow[index].row=true;
                this.viewMenu = true;

                if(this.content[index].type == 'folder'){
                    this.name = this.content[index].file;
                    this.createFolder = this.content[index].file.indexOf("on") != -1 ? this.content[index].file.slice(this.content[index].file.indexOf("on")+3) : '-';
                    this.file = false;
                    this.thing = false;
                    this.folder = true;
                } else{
                    this.name = this.content[index].file;
                    this.type = this.content[index].file_type;
                    this.lastUpdated = this.content[index].last_updated;
                    this.status = this.content[index].file_status;
                    this.size = this.content[index].size;
                    this.file = true;
                    this.thing = false;
                    this.folder = false;
                }
                
                Vue.nextTick(function() {
                    this.$refs.rightMenu.focus();

                    this.setMenu(e.y, e.x);
                }.bind(this));

                console.log('y = ', e.y);
                console.log('x = ', e.x);
                e.preventDefault();
            },

            onDrop: function(evt, type) {
                const itemID = evt.dataTransfer.getData('itemID');
                this.folderMove = type;
                this.content.splice(itemID,1);
                this.alert = true;
                this.fileToMove = '';
                this.pictToMove = '';
                this.file = false;
                this.thing = true;
                this.folder = false;
                this.showDetails = false;
                this.hideDetails = true;
            },
            dragging: function(evt){
                this.xx = true;
                Vue.nextTick(function() {
                    if(this.xx){
                        let t = evt.pageY-65;
                        let l = evt.pageX-247;

                        console.log('tM = ', t);
                        console.log('lM = ', l);

                        this.topM = t + 'px';
                        this.leftM = l + 'px';
                    }
                }.bind(this));
            },
            startDrag: function(evt, idd) {
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.fileToMove =  this.content[index].file;
                this.pictToMove = this.getImg(idd);
                this.viewMenu = false;
                evt.dataTransfer.dropEffect = 'move';
                evt.dataTransfer.effectAllowed = 'move';
                evt.dataTransfer.setData('itemID', index);
                let img = new Image();
                img.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAAUEBAAAACwAAAAAAQABAAACAkQBADs=';
                evt.dataTransfer.setDragImage(img, 0, 0);
                console.log('xx = ', this.xx);                
            },
            active: function(idd){
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                return {
                    active: this.aRow[index].row,
                    drop: (this.content[index].type == 'folder') ? true : false,
                    drag: (this.content[index].type == 'file') ? true : false
                };
            },
            clear: function(){
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.file = false;
                this.thing = true;
                this.showDetails = false;
                this.hideDetails = true;
                this.folder = false;
                this.alert = false;
                this.folderMove = '';
                this.mirror = false;
                this.viewMenu = false;
            },
            showing: function(){
                this.showDetails = !this.showDetails;
                this.hideDetails = !this.hideDetails;
                this.showFilter = false;
                this.hideFilter = true;
                this.clicked = false;
                this.viewMenu = false;
                this.mirror = !this.mirror;
            },
            show: function(){
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.file = false;
                this.thing = true;
                this.folder = false;
                this.showFilter = !this.showFilter;
                this.hideFilter = !this.hideFilter;
                this.viewMenu = false;
                this.showDetails = false;
                this.hideDetails = true;
                this.clicked = !this.clicked;
            },
            getImg: function(idd){
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                if(this.content[index].type == 'folder'){
                    return "img/folder.png";
                } else{
                    if(this.content[index].file_type  == 'docx'){
                        return "img/docs.png";
                    } else if(this.content[index].file_type  == 'jpg' || this.content[index].file_type  == 'jpeg'){
                        return "img/jpg.png";
                    }
                }
            },
            getDetails: function(idd){
                let index = 0;
                this.content.forEach((ct, i)=>{
                    if(ct.id == idd){
                        index = i;
                    }
                })
                this.aRow.forEach(fls=>{
                    fls.row = false;
                });
                this.viewMenu = false;
                this.showDetails = true;
                this.hideDetails = false;
                this.mirror = true;
                this.showFilter = false;
                this.hideFilter = true;
                this.clicked = false;
                this.aRow[index].row=true;
                if(this.content[index].type == 'folder'){
                    this.name = this.content[index].file;
                    this.createFolder = this.content[index].file.indexOf("on") != -1 ? this.content[index].file.slice(this.content[index].file.indexOf("on")+3) : '-';
                    this.file = false;
                    this.thing = false;
                    this.folder = true;
                } else{
                    this.name = this.content[index].file;
                    this.type = this.content[index].file_type;
                    this.lastUpdated = this.content[index].last_updated;
                    this.status = this.content[index].file_status;
                    this.size = this.content[index].size;
                    this.file = true;
                    this.thing = false;
                    this.folder = false;
                }
                index = 0;
            }
        }
    }
</script>

<style>
.filterForm{
    color: #BBBBBB;
    border-radius: 5px;
    height: 40px;
    border: none;
}
#sidebar {
    z-index: 2;
}
.sidebarShadow{
    z-index: 1;
    position: absolute;
    min-width: 250px;
    max-width: 250px;
    height: 122vh;
    background: #FAFAFA;
    left: 0;
    bottom: 0;
    top: 6vh;
}
.btnX{
    height: 40px;
    border-radius: 10px;
    border: none;
}
.btnX:focus{
    outline: none;
}
.btn{
    width: 100px;
    border-radius: 10px;
    background-color: #FFFFFF !important;
    color: #1890FF !important;
    box-shadow: 2px 2px 2px #ececec;
    font-weight: bold;
}
#search input[type="text"] {
    border: none;
    margin-top: 1vh;
    margin-left: 2vh;
    background: url('/img/search.png') no-repeat 10px 6px #FFFFFF;
    font: bold 12px;
    color: #777777;
    width: 170px;
    padding: 6px 15px 6px 35px;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
    -webkit-transition: all 0.7s ease 0s;
    -moz-transition: all 0.7s ease 0s;
    -o-transition: all 0.7s ease 0s;
    transition: all 0.7s ease 0s;
    }

#search input[type="text"]:focus {
    outline: none;
    width: 500px;
}
.demo-gallery ul > li > a {
    max-width: 80px;
    min-width: 80px;
}
p{
    color: #000000;
}
    table{
        color: #4A4A4A;
    }
    tr{
        height: 50px;
    }
    tbody > tr:hover{
        background-color: #E7F3FF;
    }
    .alert {
        height: 120px !important;
    }
    .bold{
        opacity: 0.9;
        background-color: red !important;
    }
    .rowM {
        display: flex;
    }

    .columnM {
        padding: 5px;
    }

    .move{
        height: 100px;
        display: block;
        z-index: 5;
        color: #000000;
        max-width: 400px;
        min-width: 400px;
        box-shadow: 10px 10px 5px #EBEBEB;
        border: 1px solid #4A85C5!important;
        background-color: #E7F3FF;
        position: absolute;
        padding: 0.75rem 1.25rem;
        border-radius: 0.25rem;
    }
    .list-enter-active{
        visibility: hidden;
    }

    .list-leave-active {
        visibility: hidden;
        transition: all 0.35s;
    }

    
    #filterLabel{
        z-index: 4; margin-top: 2vh; width: 100px; height: 40px; background-color: #FAFAFA;border-radius: 5px; left: 278px; position: absolute; cursor: pointer; font-weight: bold;
    }
    #filter{
        z-index: 1;
        left: 250px;
        max-height: 350px;
        min-height: 350px;
        right: 0;
        background-color: #E7F3FF;
        color: #4A4A4A;
        position: absolute;
        transition: 0.5s; 
    }
    
    #shadow{
        z-index: 3;
        right: 0;
        max-width: 300px;
        min-width: 300px;
        background: #E7F3FF;
        position: absolute;
        height: 350px;
    }

.fa-li {
    position: static;
}
#right-click-menu{
    background: #FFFFFF;
    border: 1px solid #BDBDBD;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);
    display: block;
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    width: 250px;
    z-index: 999999999999999;
    outline: none;
}

#right-click-menu li {
    margin: 0;
    padding: 5px;
    cursor: pointer;
    width: 100%;
}

#right-click-menu li:last-child {
    border-bottom: none;
}

#right-click-menu li:hover {
    background: #E7F3FF;
    color: #000000;
}

.alert-secondary {
    background-color: #FAFAFA;
}
.alert{
    height: 100px;
    display: block;
    z-index: 5;
    margin-left: auto !important;
    margin-right: auto !important;
    top: 5%;
    color: #000000;
    max-width: 400px;
    min-width: 400px;
    box-shadow: 10px 10px 5px #ececec;
}
.mirror{
-webkit-transform: scaleX(-1);
  transform: scaleX(-1);
}
.clicked{
    filter: invert(42%) sepia(67%) saturate(2836%) hue-rotate(193deg) brightness(102%) contrast(104%);
    color: #1890FF;
}
.showFilter{
    top: 345px !important;
}
.hideFilter{
    top: 6vh !important;
}
.showDetails{
    right: 300px !important;
}
.hideDetails{
    right: 0px !important;
}
.active{
    border: 1px solid #4A85C5!important;
    border-radius: 100px;
    background-color: #E7F3FF;
}
a:hover{
    border: 1px solid #4A85C5!important;
    border-radius: 100px;
}
    .img-responsive{
        width: 50% !important;
    }

    #detailLabel{
        z-index: 4; margin-top: 2vh; width: 30px; height: 50px; background-color: #FAFAFA;border-radius: 5px 0px 0px 5px; right: 0; position: absolute;-moz-transition: right 0.5s ease; 
            transition: right 0.5s ease; cursor: pointer;
    }
    body { background: #FFFFFF; font-family: 'Roboto Condensed'; }
    .container { margin: 150px auto; }
    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
    }
    .wrapperContent {
        display: flex;
        width: 100%;
        align-items: stretch;
        height: 94vh;
    }
    .list-group-item {
        background-color: #FAFAFA;
    }
    #stendard{
        width: 150px;
    }
    #tree{
        border: none !important;
    }
    .list-group-item {
        border: none;
    }
    #content {
        padding: 0;
    }
    /* here */
    input[type="checkbox"] { 
            display: none; 
    } 

    /* Toggling of sidebar */ 
    input:checked~#detailLabel { 
        right: 300px; 
    } 

    input:checked~.demo-gallery { 
        right: 300px; 
    } 

    #topNav {
        height: 6vh;
        background-color: #4A85C5;
    }


    #rightbar{
        z-index: 2;
        right: 0;
        max-width: 300px;
        min-width: 300px;
        background: #FAFAFA;
        color: #4A4A4A;
        position: absolute;
        height: 94vh;
        transition: 0.5s; 
    }

@media (min-width: 992px){
    .col-lg-2 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 16.6666666667%;
        flex: 0 0 1%;
        max-width: 21%;
    }
}


.demo-gallery {
    padding: 20px;
    right: 0;
    position: absolute;
    left: 250px;
    background-color: #FFFFFF;
    bottom: 0;
    top: 6vh;
    /* top: 26vh; */
    z-index: 3;
    height: 94vh;
     -moz-transition: top 0.5s ease, right 0.5s ease; 
        transition: top 0.5s ease, right 0.5s ease; 
}

.demo-gallery > ul {
  margin-bottom: 0;
  margin-top: 10vh;
}
.demo-gallery > ul > li {
    float: left;
    margin-bottom: 15px;
    width: 200px;
}
.demo-gallery > ul > li a { 
  border: 3px solid #FFF;
  border-radius: 3px;
  display: block;
  overflow: hidden;
  position: relative;
  float: left;
}
.demo-gallery > ul > li a > img {
  -webkit-transition: -webkit-transform 0.15s ease 0s;
  -moz-transition: -moz-transform 0.15s ease 0s;
  -o-transition: -o-transform 0.15s ease 0s;
  transition: transform 0.15s ease 0s;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  height: 100%;
  width: 100%;
}
.demo-gallery > ul > li a:hover > img {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
}
.demo-gallery > ul > li a:hover .demo-gallery-poster > img {
  opacity: 1;
}
.demo-gallery > ul > li a .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.1);
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  -webkit-transition: background-color 0.15s ease 0s;
  -o-transition: background-color 0.15s ease 0s;
  transition: background-color 0.15s ease 0s;
}
.demo-gallery > ul > li a .demo-gallery-poster > img {
  left: 50%;
  margin-left: -10px;
  margin-top: -10px;
  opacity: 0;
  position: absolute;
  top: 50%;
  -webkit-transition: opacity 0.3s ease 0s;
  -o-transition: opacity 0.3s ease 0s;
  transition: opacity 0.3s ease 0s;
}
.demo-gallery > ul > li a:hover .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.5);
}
.demo-gallery .justified-gallery > a > img {
  -webkit-transition: -webkit-transform 0.15s ease 0s;
  -moz-transition: -moz-transform 0.15s ease 0s;
  -o-transition: -o-transform 0.15s ease 0s;
  transition: transform 0.15s ease 0s;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  height: 100%;
  width: 100%;
}
.demo-gallery .justified-gallery > a:hover > img {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
}
.demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
  opacity: 1;
}
.demo-gallery .justified-gallery > a .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.1);
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  -webkit-transition: background-color 0.15s ease 0s;
  -o-transition: background-color 0.15s ease 0s;
  transition: background-color 0.15s ease 0s;
}
.demo-gallery .justified-gallery > a .demo-gallery-poster > img {
  left: 50%;
  margin-left: -10px;
  margin-top: -10px;
  opacity: 0;
  position: absolute;
  top: 50%;
  -webkit-transition: opacity 0.3s ease 0s;
  -o-transition: opacity 0.3s ease 0s;
  transition: opacity 0.3s ease 0s;
}
.demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.5);
}
.demo-gallery .video .demo-gallery-poster img {
  height: 48px;
  margin-left: -24px;
  margin-top: -24px;
  opacity: 0.8;
  width: 48px;
}
.demo-gallery.dark > ul > li a {
  border: 3px solid #04070a;
}
.home .demo-gallery {
  padding-bottom: 80px; 
}
</style>