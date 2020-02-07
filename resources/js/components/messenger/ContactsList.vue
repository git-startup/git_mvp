<template> 
    <div class="contacts-list">
        <!-- mail side navigation -->
          <nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left" style="z-index:3;width:320px;" id="mySidebar">
            <!-- close side bar -->
            <a href="javascript:void(0)" onclick="w3_close()" title="Close Sidemenu" 
            class="w3-bar-item w3-button w3-hide-large w3-large">اغلاق <i class="fa fa-remove"></i></a>
            
            <div class="w3-animate-left">
               <!-- contact section -->
               <ul>
                    <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                      <a href="javascript:void(0)" class="w3-bar-item w3-button w3-hover-light-grey text-right">
                        <div class="w3-container">
                          <img class="w3-round w3-margin-right" :src="contact.image" :alt="contact.name" style="width:15%;"><span class="w3-opacity w3-large">{{ contact.name }}</span>
                          <p>{{ contact.location }}</p>
                        </div>
                      </a>
                      <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
                    </li>
                </ul>
              <!-- end contact section -->
            </div>
        </nav>
    </div> 
</template>  

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;

                this.$emit('selected', contact);
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread;
                }]).reverse();
            }
        }
    }
</script>

<style lang="scss" scoped>
.contacts-list {
    max-height: 600px;
    overflow: scroll;
    border-left: 1px solid #a6a6a6;
    
    ul {
        list-style-type: none;
        padding-left: 0;

        li {
            border-bottom: 1px solid #aaaaaa;
            height: 80px;
            position: relative;
            cursor: pointer;

            &.selected {
                background: #dfdfdf;
            }

            span.unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }

            .avatar {
                flex: 1;
                display: flex;
                align-items: center;

                img {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }

            .contact {
                flex: 3;
                font-size: 10px;
                display: flex;
                overflow: hidden;
                flex-direction: column;
                justify-content: center;

                p {
                    margin: 0;

                    &.name {
                        font-weight: bold;
                        font-size: 14px;
                    }
                    &.email{
                        font-size: 14px;
                    }
                }
            }
        }
    }
}

</style>