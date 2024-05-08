create table series
    (ID                  int not null auto_increment,
     title               varchar(100) not null,
     synopsis            varchar(1000),
     rating              numeric(2, 1) check (rating >= 0),
     thumbnail_reference varchar(1000),
     num_of_eps          numeric(3),
     num_of_seasons      numeric(2),
     primary key (ID)
    );

create table user
    (ID               int not null auto_increment,
     username         varchar(30) not null unique,
     password         varchar(30) not null,
     subsc_plan       varchar(10) not null,
     subsc_renew_date date,
     location         varchar(60) not null,
     color            varchar(7) not null DEFAULT '#DA1035',
     primary key (ID)
    );

create table video
    (ID                  int not null auto_increment,
     title               varchar(100) not null,
     synopsis            varchar(1000),
     runtime             time,
     thumbnail_reference varchar(1000),
     rating              numeric(2, 1) check (rating >= 0),
     subsc_plan_required varchar(10) not null,
     video_reference     varchar(100) not null,
     vid_type            varchar(7) not null,
     genre               varchar(20),
     primary key(ID)
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
