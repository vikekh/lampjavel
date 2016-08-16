drop table if exists `lampjavel_image_tags`;
drop table if exists `lampjavel_channel_members`;
drop table if exists `lampjavel_channel_images`;
drop table if exists `lampjavel_channel_admins`;
drop table if exists `lampjavel_users`;
drop table if exists `lampjavel_tags`;
drop table if exists `lampjavel_images`;
drop table if exists `lampjavel_channels`;

create table `lampjavel_channels` (
    `id` varchar(20) not null,
    `is_public` boolean,
    `created_at` timestamp not null default '0000-00-00 00:00:00',
    `updated_at` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
);

create table `lampjavel_images` (
    `id` int(9) not null auto_increment,
    `url` varchar(100) not null,
    `created_at` timestamp not null default '0000-00-00 00:00:00',
    `updated_at` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
);

create table `lampjavel_tags` (
    `id` varchar(20) not null,
    `created_at` timestamp not null default '0000-00-00 00:00:00',
    `updated_at` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
);

create table `lampjavel_users` (
    `id` varchar(20) not null,
    `email` varchar(100) not null,
    `password_hash` varchar(255) default null,
    `created_at` timestamp not null default '0000-00-00 00:00:00',
    `updated_at` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
);

create table `lampjavel_channel_admins` (
    `channel_id` varchar(20) not null,
    `user_id` varchar(20) not null,
    foreign key (`channel_id`) references `lampjavel_channels` (`id`),
    foreign key (`user_id`) references `lampjavel_users` (`id`),
    unique (`channel_id`, `user_id`)
);

create table `lampjavel_channel_images` (
    `channel_id` varchar(20) not null,
    `image_id` int(9) not null,
    foreign key (`channel_id`) references `lampjavel_channels` (`id`),
    foreign key (`image_id`) references `lampjavel_images` (`id`),
    unique (`channel_id`, `image_id`)
);

create table `lampjavel_channel_members` (
    `channel_id` varchar(20) not null,
    `user_id` varchar(20) not null,
    foreign key (`channel_id`) references `lampjavel_channels` (`id`),
    foreign key (`user_id`) references `lampjavel_users` (`id`),
    unique (`channel_id`, `user_id`)
);

create table `lampjavel_image_tags` (
    `image_id` int(9) not null,
    `tag_id` varchar(20) not null,
    foreign key (`image_id`) references `lampjavel_images` (`id`),
    foreign key (`tag_id`) references `lampjavel_tags` (`id`),
    unique (`image_id`, `tag_id`)
);

insert into `lampjavel_users` (`id`, `email`, `created_at`, `updated_at`) values
('admin', 'admin@admin.com', null, null);