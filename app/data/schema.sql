drop table if exists `lampjavel_image_tags`;
drop table if exists `lampjavel_channel_members`;
drop table if exists `lampjavel_channel_images`;
drop table if exists `lampjavel_channel_admins`;
drop table if exists `lampjavel_users`;
drop table if exists `lampjavel_tags`;
drop table if exists `lampjavel_images`;
drop table if exists `lampjavel_channels`;

create table `lampjavel_channels` (
    `name` varchar(20) not null,
    `public` boolean,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`name`)
);

create table `lampjavel_images` (
    `id` int(9) not null auto_increment,
    `url` varchar(100) not null,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`)
);

create table `lampjavel_tags` (
    `name` varchar(20) not null,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`name`)
);

create table `lampjavel_users` (
    `username` varchar(20) not null,
    `email` varchar(100) not null,
    `password_hash` varchar(255) default null,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`username`)
);

create table `lampjavel_channel_admins` (
    `channel_name` varchar(20) not null,
    `username` varchar(20) not null,
    foreign key (`channel_name`) references `lampjavel_channels` (`name`),
    foreign key (`username`) references `lampjavel_users` (`username`),
    unique (`channel_name`, `username`)
);

create table `lampjavel_channel_images` (
    `channel_name` varchar(20) not null,
    `image_id` int(9) not null,
    foreign key (`channel_name`) references `lampjavel_channels` (`name`),
    foreign key (`image_id`) references `lampjavel_images` (`id`),
    unique (`channel_name`, `image_id`)
);

create table `lampjavel_channel_members` (
    `channel_name` varchar(20) not null,
    `username` varchar(20) not null,
    foreign key (`channel_name`) references `lampjavel_channels` (`name`),
    foreign key (`username`) references `lampjavel_users` (`username`),
    unique (`channel_name`, `username`)
);

create table `lampjavel_image_tags` (
    `image_id` int(9) not null,
    `tag_name` varchar(20) not null,
    foreign key (`image_id`) references `lampjavel_images` (`id`),
    foreign key (`tag_name`) references `lampjavel_tags` (`name`),
    unique (`image_id`, `tag_name`)
);

insert into `lampjavel_users` (`username`, `email`, `created`, `updated`) values
('admin', 'admin@admin.com', null, null);

insert into `lampjavel_channels` (`name`, `public`, `created`, `updated`) values
('lampjavel', true, null, null);

insert into `lampjavel_channel_admins` (`channel_name`, `username`) values
('lampjavel', 'admin');

insert into `lampjavel_images` (`url`, `created`, `updated`) values
('http://i.imgur.com/MRxVkZw.png', null, null);

insert into `lampjavel_channel_images` (`channel_name`, `image_id`) values
('lampjavel', last_insert_id());