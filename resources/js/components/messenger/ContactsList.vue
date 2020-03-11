<template>
  <div class="contacts-list">
    <nav class="w3-sidebar w3-bar-block w3-animate-left">
      <div class="w3-animate-left">
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
                // close contact menu
                document.getElementById("contacts_list").style.display = 'none'
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
    position: absolute;
    right: 0px;
    max-height: 600px;
    margin-top: -20px;

    nav{
      background-color: rgba(0,0,0,.03);
      z-index:99;
      width:320px;
      height: 600px;
    }
    @media screen and (max-width: 480px){
      nav{
        width:220px
      }
    }

    ul {
        list-style-type: none;
        padding-left: 0;

        li {
            border-bottom: 1px solid #aaaaaa;
            height: 100%;
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
                align-items: center;
                img {
                    width: 80px;
                    height: 80px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }

            .contact {

                font-size: 10px;

                overflow: hidden;

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
