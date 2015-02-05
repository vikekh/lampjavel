drop table if exists `lampjavel_category_images`;
drop table if exists `lampjavel_channel_images`;
drop table if exists `lampjavel_channel_members`;
drop table if exists `lampjavel_categories`;
drop table if exists `lampjavel_images`;
drop table if exists `lampjavel_channels`;
drop table if exists `lampjavel_users`;

create table `lampjavel_users` (
    `username` varchar(20) not null,
    `email` varchar(100) not null,
    `password_hash` varchar(255) default null,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`username`)
);

create table `lampjavel_channels` (
    `name` varchar(20) not null,
    `admin` varchar(20) default null,
    `public` boolean,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`name`),
    foreign key (`admin`) references `lampjavel_users` (`username`)
);

create table `lampjavel_images` (
    `id` int(9) not null auto_increment,
    `channel_name` varchar(20) not null,
    `url` varchar(100) not null,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`id`),
    foreign key (`channel_name`) references `lampjavel_channels` (`name`)
);

create table `lampjavel_categories` (
    `name` varchar(20) not null,
    `channel_name` varchar(20) default null,
    `created` timestamp not null default '0000-00-00 00:00:00',
    `updated` timestamp not null default current_timestamp on update current_timestamp,
    primary key (`name`),
    foreign key (`channel_name`) references `lampjavel_channels` (`name`)
);

create table `lampjavel_channel_members` (
    `channel_name` varchar(20) default null,
    `username` varchar(20) not null,
    foreign key (`channel_name`) references `lampjavel_channels` (`name`),
    foreign key (`username`) references `lampjavel_users` (`username`),
    unique (`channel_name`, `username`)
);

create table `lampjavel_category_images` (
    `category_name` varchar(20) not null,
    `image_id` int(9) not null,
    foreign key (`category_name`) references `lampjavel_categories` (`name`),
    foreign key (`image_id`) references `lampjavel_images` (`id`),
    unique (`category_name`, `image_id`)
);

insert into `lampjavel_users` (`username`, `email`, `created`, `updated`) values
('admin', 'admin@admin.com', null, null);