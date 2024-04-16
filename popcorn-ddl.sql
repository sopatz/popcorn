create table series
    (ID                  int not null auto_increment,
     title               varchar(100),
     synopsis            varchar(1000),
     rating              numeric(2, 1) check (rating >= 0),
     thumbnail_reference varchar(100),
     num_of_eps          numeric(4),
     num_of_seasons      numeric(2),
     primary key (ID)
    );

create table user
    (ID               int not null auto_increment,
     username         varchar(30) not null unique,
     password         varchar(30) not null,
     subsc_plan       varchar(10),
     subsc_renew_date date,
     location         varchar(60),
     primary key (ID)
    );

create table video
    (ID                  int not null auto_increment,
     title               varchar(100),
     synopsis            varchar(1000),
     runtime             time,
     thumbnail_reference varchar(100),
     rating              numeric(2, 1) check (rating >= 0),
     subsc_plan_required varchar(10),
     vid_type            varchar(7),
     genre               varchar(20),
     primary key(ID)
    );

create table countries_available
    (video_ID     int,
     country_name varchar(56),
     primary key(video_ID, country_name),
     foreign key (video_ID) references video (ID)
        on delete cascade
    );

create table watches
    (video_ID           int,
     user_ID            int,
     time_through_video time,
     primary key (video_ID, user_ID),
     foreign key (video_ID) references video (ID)
        on delete cascade,
     foreign key (user_ID) references user (ID)
        on delete cascade
    );

create table watchlist
    (user_ID   int,
     series_ID int,
     primary key (user_ID, series_ID),
     foreign key (user_ID) references user (ID)
        on delete cascade,
     foreign key (series_ID) references series (ID)
        on delete cascade
    );

create table is_part_of
    (video_ID       int,
     series_ID      int,
     season_number  varchar(2),
     episode_number varchar(3),
     primary key (video_ID, series_ID),
     foreign key (video_ID) references video (ID)
        on delete cascade,
     foreign key (series_ID) references series (ID)
        on delete cascade
    );