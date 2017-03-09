drop table if exists usuarios cascade;

create table usuarios(
    id      bigserial       constraint pk_usuarios primary key,
    nombre  varchar(255)    not null,
    pass    varchar(60)     not null
);
insert into usuarios(nombre, pass) values
    ('pepe', crypt('pepe', gen_salt('bf'))),
    ('jose', crypt('jose', gen_salt('bf')));

drop table if exists cuentas cascade;

create table cuentas(
    id              bigserial       constraint pk_cuentas primary key,
    numero          numeric (20)    not null unique,
    fecha_creacion  timestamptz     not null default current_timestamp,
    usuario_id      bigint          not null constraint fk_cuentas_usuarios
                                        references usuarios (id)
                                        on delete no action on update cascade
);
insert into cuentas(numero, fecha_creacion, usuario_id) values
        (123123, current_timestamp - '2 day'::interval, 1),
        (23123, current_timestamp - '3 day'::interval, 1),
        (13123, current_timestamp - '2 day'::interval, 2);

drop table if exists movimientos cascade;

create table movimientos(
    id          bigserial           constraint pk_movimientos primary key,
    fecha_mov   timestamptz         not null default current_timestamp,
    concepto    varchar(150)        not null,
    ingreso     numeric(7,2)        not null,
    cuenta_id   bigint              not null constraint fk_movimientos_cuentas
                                        references cuentas (id)
                                        on delete no action on update cascade
);
insert into movimientos(fecha_mov, concepto, ingreso, cuenta_id) values
    (current_timestamp - '1 day'::interval, 'Ingreso en cuenta', 2, 1),
    (current_timestamp - '1 day'::interval, 'Ingreso en cuenta', 3, 1),
    (current_timestamp - '1 day'::interval, 'Ingreso en cuenta', 4, 2),
    (current_timestamp - '1 day'::interval, 'Ingreso en cuenta', 23, 3),
    (current_timestamp - '1 day'::interval, 'Ingreso en cuenta', 3, 3);
