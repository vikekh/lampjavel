create table `lampjavel_images` (
    `id` int(9) not null auto_increment,
    `image_url` varchar(100) not null,
    `created_timestamp` timestamp not null default '0000-00-00 00:00:00',
    `updated_timestamp` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
);

create table `lampjavel_channels` (
    `id` varchar(20) not null,
    `created_timestamp` timestamp not null default '0000-00-00 00:00:00',
    `updated_timestamp` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
);

create table `lampjavel_users` (
    `id` varchar(20) not null,
    `email` varchar(100) not null,
    `password_hash` varchar(255),
    `created_timestamp` timestamp not null default '0000-00-00 00:00:00',
    `updated_timestamp` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
)

create table `lampjavel_channel_images` (
    `channel_id` varchar(20) not null,
    `image_id` int(9) not null,
    unique (`channel_id`, `image_id`),
    foreign key (`channel_id`) references `lampjavel_channels` (`id`),
    foreign key (`image_id`) references `lampjavel_images` (`id`)
);