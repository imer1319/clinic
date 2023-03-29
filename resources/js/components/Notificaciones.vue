<template>
	<li role="presentation" class="nav-item dropdown open" v-if="notifications.length">
		<a href="javascript:;" @click.prevent="goNoti" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown"
			aria-expanded="false">
			<i class="fa fa-bell-o text-white" style="font-size: 20px; padding-top: 6px;"></i>
			<span v-if="notifications.length" class="badge bg-green">{{ notifications.length }}</span>
		</a>
		<ul v-if="notifications.length" class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
			<li class="nav-item" v-for="notification in notifications">
				<a class="dropdown-item" @click.prevent="updateNotification(notification)">
					<span>
						<span>Para {{ user.name }}</span>
						<span class="time">Hace {{ notification.created_at }}</span>
					</span>
					<span class="message">
						{{ notification.body }}
					</span>
				</a>
			</li>
			<div class="divider"></div>
			<li class="nav-item">
				<div class="text-center">
					<a class="dropdown-item" href="/notifications">
						<strong>Ver todas las notificaciones</strong>
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
			</li>
		</ul>
	</li>
</template>
<script>
export default {
	props: ['user'],
	mounted() {
		axios.get('/api/notifications/' + this.user.id)
			.then(res => {
				this.notifications = res.data
			})
	},
	data() {
		return {
			notifications: []
		}
	},
	methods:{
		updateNotification(notification){
			axios.put('/api/notifications/' + notification.id)
			window.location.href = '/notifications'
		},
		goNoti(){
			if (this.notifications.length) {
				return
			}
			window.location.href = '/notifications'
		}
	},
}
</script>