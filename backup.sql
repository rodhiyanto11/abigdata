PGDMP         #                w            abigdata    11.4    11.4 R    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            �           1262    17535    abigdata    DATABASE     f   CREATE DATABASE abigdata WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'C' LC_CTYPE = 'C';
    DROP DATABASE abigdata;
             postgres    false            �            1259    17538 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         postgres    false            �            1259    17536    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public       postgres    false    197            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
            public       postgres    false    196            �            1259    17938    oauth_access_tokens    TABLE     f  CREATE TABLE public.oauth_access_tokens (
    id character varying(100) NOT NULL,
    user_id integer,
    client_id integer NOT NULL,
    name character varying(255),
    scopes text,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone
);
 '   DROP TABLE public.oauth_access_tokens;
       public         postgres    false            �            1259    17930    oauth_auth_codes    TABLE     �   CREATE TABLE public.oauth_auth_codes (
    id character varying(100) NOT NULL,
    user_id integer NOT NULL,
    client_id integer NOT NULL,
    scopes text,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);
 $   DROP TABLE public.oauth_auth_codes;
       public         postgres    false            �            1259    17955    oauth_clients    TABLE     �  CREATE TABLE public.oauth_clients (
    id integer NOT NULL,
    user_id integer,
    name character varying(255) NOT NULL,
    secret character varying(100) NOT NULL,
    redirect text NOT NULL,
    personal_access_client boolean NOT NULL,
    password_client boolean NOT NULL,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 !   DROP TABLE public.oauth_clients;
       public         postgres    false            �            1259    17953    oauth_clients_id_seq    SEQUENCE     �   CREATE SEQUENCE public.oauth_clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.oauth_clients_id_seq;
       public       postgres    false    205            �           0    0    oauth_clients_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.oauth_clients_id_seq OWNED BY public.oauth_clients.id;
            public       postgres    false    204            �            1259    17967    oauth_personal_access_clients    TABLE     �   CREATE TABLE public.oauth_personal_access_clients (
    id integer NOT NULL,
    client_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 1   DROP TABLE public.oauth_personal_access_clients;
       public         postgres    false            �            1259    17965 $   oauth_personal_access_clients_id_seq    SEQUENCE     �   CREATE SEQUENCE public.oauth_personal_access_clients_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.oauth_personal_access_clients_id_seq;
       public       postgres    false    207            �           0    0 $   oauth_personal_access_clients_id_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.oauth_personal_access_clients_id_seq OWNED BY public.oauth_personal_access_clients.id;
            public       postgres    false    206            �            1259    17947    oauth_refresh_tokens    TABLE     �   CREATE TABLE public.oauth_refresh_tokens (
    id character varying(100) NOT NULL,
    access_token_id character varying(100) NOT NULL,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);
 (   DROP TABLE public.oauth_refresh_tokens;
       public         postgres    false            �            1259    17989    pages    TABLE     �  CREATE TABLE public.pages (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    model character varying(255) NOT NULL,
    controller character varying(255) NOT NULL,
    view character varying(255) NOT NULL,
    note text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    routename character varying(255),
    "position" character varying(255),
    icons character varying(255),
    pagelink integer
);
    DROP TABLE public.pages;
       public         postgres    false            �            1259    17987    pages_id_seq    SEQUENCE     u   CREATE SEQUENCE public.pages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.pages_id_seq;
       public       postgres    false    211            �           0    0    pages_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.pages_id_seq OWNED BY public.pages.id;
            public       postgres    false    210            �            1259    17923    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         postgres    false            �            1259    18006 
   role_pages    TABLE     �   CREATE TABLE public.role_pages (
    id bigint NOT NULL,
    role_id integer NOT NULL,
    page_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.role_pages;
       public         postgres    false            �            1259    18004    role_pages_id_seq    SEQUENCE     z   CREATE SEQUENCE public.role_pages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.role_pages_id_seq;
       public       postgres    false    213            �           0    0    role_pages_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.role_pages_id_seq OWNED BY public.role_pages.id;
            public       postgres    false    212            �            1259    17976    roles    TABLE     �   CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    note text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.roles;
       public         postgres    false            �            1259    17974    roles_id_seq    SEQUENCE     u   CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.roles_id_seq;
       public       postgres    false    209            �           0    0    roles_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;
            public       postgres    false    208            �            1259    18018 
   user_roles    TABLE     �   CREATE TABLE public.user_roles (
    id bigint NOT NULL,
    user_id integer NOT NULL,
    role_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.user_roles;
       public         postgres    false            �            1259    18016    user_roles_id_seq    SEQUENCE     z   CREATE SEQUENCE public.user_roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.user_roles_id_seq;
       public       postgres    false    215            �           0    0    user_roles_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.user_roles_id_seq OWNED BY public.user_roles.id;
            public       postgres    false    214            �            1259    17910    users    TABLE     �  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    role_id integer NOT NULL,
    username character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    expired_date timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         postgres    false            �            1259    17908    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public       postgres    false    199            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
            public       postgres    false    198            �           2604    17541    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196    197            �           2604    17958    oauth_clients id    DEFAULT     t   ALTER TABLE ONLY public.oauth_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_clients_id_seq'::regclass);
 ?   ALTER TABLE public.oauth_clients ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    204    205    205            �           2604    17970     oauth_personal_access_clients id    DEFAULT     �   ALTER TABLE ONLY public.oauth_personal_access_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_personal_access_clients_id_seq'::regclass);
 O   ALTER TABLE public.oauth_personal_access_clients ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    207    206    207                        2604    17992    pages id    DEFAULT     d   ALTER TABLE ONLY public.pages ALTER COLUMN id SET DEFAULT nextval('public.pages_id_seq'::regclass);
 7   ALTER TABLE public.pages ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    211    210    211                       2604    18009    role_pages id    DEFAULT     n   ALTER TABLE ONLY public.role_pages ALTER COLUMN id SET DEFAULT nextval('public.role_pages_id_seq'::regclass);
 <   ALTER TABLE public.role_pages ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    213    212    213            �           2604    17979    roles id    DEFAULT     d   ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);
 7   ALTER TABLE public.roles ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    208    209    209                       2604    18021    user_roles id    DEFAULT     n   ALTER TABLE ONLY public.user_roles ALTER COLUMN id SET DEFAULT nextval('public.user_roles_id_seq'::regclass);
 <   ALTER TABLE public.user_roles ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    214    215    215            �           2604    17913    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    199    198    199            �          0    17538 
   migrations 
   TABLE DATA               :   COPY public.migrations (id, migration, batch) FROM stdin;
    public       postgres    false    197   T`       �          0    17938    oauth_access_tokens 
   TABLE DATA               �   COPY public.oauth_access_tokens (id, user_id, client_id, name, scopes, revoked, created_at, updated_at, expires_at) FROM stdin;
    public       postgres    false    202   /a       �          0    17930    oauth_auth_codes 
   TABLE DATA               _   COPY public.oauth_auth_codes (id, user_id, client_id, scopes, revoked, expires_at) FROM stdin;
    public       postgres    false    201   �a       �          0    17955    oauth_clients 
   TABLE DATA               �   COPY public.oauth_clients (id, user_id, name, secret, redirect, personal_access_client, password_client, revoked, created_at, updated_at) FROM stdin;
    public       postgres    false    205   �a       �          0    17967    oauth_personal_access_clients 
   TABLE DATA               ^   COPY public.oauth_personal_access_clients (id, client_id, created_at, updated_at) FROM stdin;
    public       postgres    false    207   'c       �          0    17947    oauth_refresh_tokens 
   TABLE DATA               X   COPY public.oauth_refresh_tokens (id, access_token_id, revoked, expires_at) FROM stdin;
    public       postgres    false    203   ^c       �          0    17989    pages 
   TABLE DATA               �   COPY public.pages (id, name, model, controller, view, note, created_at, updated_at, routename, "position", icons, pagelink) FROM stdin;
    public       postgres    false    211   �c       �          0    17923    password_resets 
   TABLE DATA               C   COPY public.password_resets (email, token, created_at) FROM stdin;
    public       postgres    false    200   e       �          0    18006 
   role_pages 
   TABLE DATA               R   COPY public.role_pages (id, role_id, page_id, created_at, updated_at) FROM stdin;
    public       postgres    false    213   !e       �          0    17976    roles 
   TABLE DATA               G   COPY public.roles (id, name, note, created_at, updated_at) FROM stdin;
    public       postgres    false    209   �e       �          0    18018 
   user_roles 
   TABLE DATA               R   COPY public.user_roles (id, user_id, role_id, created_at, updated_at) FROM stdin;
    public       postgres    false    215   �e       �          0    17910    users 
   TABLE DATA               �   COPY public.users (id, name, role_id, username, email, email_verified_at, expired_date, password, remember_token, created_at, updated_at) FROM stdin;
    public       postgres    false    199   f       �           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 46, true);
            public       postgres    false    196            �           0    0    oauth_clients_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.oauth_clients_id_seq', 4, true);
            public       postgres    false    204            �           0    0 $   oauth_personal_access_clients_id_seq    SEQUENCE SET     R   SELECT pg_catalog.setval('public.oauth_personal_access_clients_id_seq', 1, true);
            public       postgres    false    206            �           0    0    pages_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.pages_id_seq', 16, true);
            public       postgres    false    210            �           0    0    role_pages_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.role_pages_id_seq', 19, true);
            public       postgres    false    212            �           0    0    roles_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.roles_id_seq', 2, true);
            public       postgres    false    208            �           0    0    user_roles_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.user_roles_id_seq', 1, true);
            public       postgres    false    214            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 2, true);
            public       postgres    false    198                       2606    17543    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public         postgres    false    197                       2606    17945 ,   oauth_access_tokens oauth_access_tokens_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.oauth_access_tokens
    ADD CONSTRAINT oauth_access_tokens_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.oauth_access_tokens DROP CONSTRAINT oauth_access_tokens_pkey;
       public         postgres    false    202                       2606    17937 &   oauth_auth_codes oauth_auth_codes_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.oauth_auth_codes
    ADD CONSTRAINT oauth_auth_codes_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.oauth_auth_codes DROP CONSTRAINT oauth_auth_codes_pkey;
       public         postgres    false    201                       2606    17963     oauth_clients oauth_clients_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.oauth_clients
    ADD CONSTRAINT oauth_clients_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.oauth_clients DROP CONSTRAINT oauth_clients_pkey;
       public         postgres    false    205                       2606    17972 @   oauth_personal_access_clients oauth_personal_access_clients_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.oauth_personal_access_clients
    ADD CONSTRAINT oauth_personal_access_clients_pkey PRIMARY KEY (id);
 j   ALTER TABLE ONLY public.oauth_personal_access_clients DROP CONSTRAINT oauth_personal_access_clients_pkey;
       public         postgres    false    207                       2606    17951 .   oauth_refresh_tokens oauth_refresh_tokens_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.oauth_refresh_tokens
    ADD CONSTRAINT oauth_refresh_tokens_pkey PRIMARY KEY (id);
 X   ALTER TABLE ONLY public.oauth_refresh_tokens DROP CONSTRAINT oauth_refresh_tokens_pkey;
       public         postgres    false    203                       2606    17999    pages pages_name_unique 
   CONSTRAINT     R   ALTER TABLE ONLY public.pages
    ADD CONSTRAINT pages_name_unique UNIQUE (name);
 A   ALTER TABLE ONLY public.pages DROP CONSTRAINT pages_name_unique;
       public         postgres    false    211            !           2606    17997    pages pages_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.pages
    ADD CONSTRAINT pages_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.pages DROP CONSTRAINT pages_pkey;
       public         postgres    false    211            #           2606    18011    role_pages role_pages_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.role_pages
    ADD CONSTRAINT role_pages_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.role_pages DROP CONSTRAINT role_pages_pkey;
       public         postgres    false    213                       2606    17986    roles roles_name_unique 
   CONSTRAINT     R   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_unique UNIQUE (name);
 A   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_name_unique;
       public         postgres    false    209                       2606    17984    roles roles_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public         postgres    false    209            %           2606    18023    user_roles user_roles_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.user_roles
    ADD CONSTRAINT user_roles_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.user_roles DROP CONSTRAINT user_roles_pkey;
       public         postgres    false    215            '           2606    18027 $   user_roles user_roles_role_id_unique 
   CONSTRAINT     b   ALTER TABLE ONLY public.user_roles
    ADD CONSTRAINT user_roles_role_id_unique UNIQUE (role_id);
 N   ALTER TABLE ONLY public.user_roles DROP CONSTRAINT user_roles_role_id_unique;
       public         postgres    false    215            )           2606    18025 $   user_roles user_roles_user_id_unique 
   CONSTRAINT     b   ALTER TABLE ONLY public.user_roles
    ADD CONSTRAINT user_roles_user_id_unique UNIQUE (user_id);
 N   ALTER TABLE ONLY public.user_roles DROP CONSTRAINT user_roles_user_id_unique;
       public         postgres    false    215                       2606    17922    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public         postgres    false    199                       2606    17918    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public         postgres    false    199            
           2606    17920    users users_username_unique 
   CONSTRAINT     Z   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);
 E   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_unique;
       public         postgres    false    199                       1259    17946 !   oauth_access_tokens_user_id_index    INDEX     d   CREATE INDEX oauth_access_tokens_user_id_index ON public.oauth_access_tokens USING btree (user_id);
 5   DROP INDEX public.oauth_access_tokens_user_id_index;
       public         postgres    false    202                       1259    17964    oauth_clients_user_id_index    INDEX     X   CREATE INDEX oauth_clients_user_id_index ON public.oauth_clients USING btree (user_id);
 /   DROP INDEX public.oauth_clients_user_id_index;
       public         postgres    false    205                       1259    17973 -   oauth_personal_access_clients_client_id_index    INDEX     |   CREATE INDEX oauth_personal_access_clients_client_id_index ON public.oauth_personal_access_clients USING btree (client_id);
 A   DROP INDEX public.oauth_personal_access_clients_client_id_index;
       public         postgres    false    207                       1259    17952 *   oauth_refresh_tokens_access_token_id_index    INDEX     v   CREATE INDEX oauth_refresh_tokens_access_token_id_index ON public.oauth_refresh_tokens USING btree (access_token_id);
 >   DROP INDEX public.oauth_refresh_tokens_access_token_id_index;
       public         postgres    false    203                       1259    17929    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public         postgres    false    200            �   �   x�e�[� E��b�L���d�t|Ħ�q�bM-B��4;���f5/vA�$��"O�<�<�$������� Q��9~�*m����x��n<���I]%���$����G���\Ҁ�J�J�Rt�]��]�+�-�g�ΏvXf��б:�N�#j얄������D�ۿ�kN�i I�[ܬ8��`�c���9N��i>Sݭ�      �   n   x�}ȱ�0 �M����Y v!����J����=�f�^Cē��@�a|���nB��1���+c�������*JC�k��>$4$�8j�/�����J��rn��/��$U      �      x������ � �      �   M  x����r�@�����83<eG�G�"	Q�"���~}U�1f���]�=��`GUtLr�M*J�(�8N(��|��7�~���Z�^����:�ej�k��B笂������$��PH��zP�a����.�e��D��H���UT�+�t�E�6��n6C�3��C!�
$�x�٪�#%�0��� �f��n�?C²I�2�j�p:�zsgO�e�=��EF3�Z�X@�& a#��O� �<�tYձt��� rR���܎�ܥqZډ��,*
\�C����]�a��<��k®��j4�Z���I�.���q�)���      �   '   x�3�4�420��50�52S00�20�25�&����� ��      �   �   x���C1��)�@Y_+���,k�b��8��d�H��Σm�.YDcL +Wq��up��ҳWKm�R��;ٜ�x=�U����s6L
����mM�YMR��N���"���2�]'	>�  ��ި/�/���}��(0j      �   �   x�m���0E��+�L�H��6��������0����`2Log��E�F�!t&�n���QkPW�]v6�1�"�F1	�4�z��:ߣ�h«��s@btT���v���6�Ӑd�H2�����rV����z���\Cv0��v�D�y��j�g;S�.�o��Y�P��r@���m���b�Y�	C>ң�vD�`Y�˿3�,'�1�j���5�R\�%�)��^V�eΞ�y�|��L�J���m�&o���*�/�L��      �      x������ � �      �   q   x�m��1�ln�"�`�LW��_G�':%H|�U(CL�����#\�Y1�����Z1�2�[�+��=���_���׭В�c��t�)�f`��|�ug����b�_ >�6�      �   @   x�3�LL������420��50�52U04�2��24�&�e�YZ�Z���B���
���q��qqq ��^      �      x�3�4�? ����� w�      �   �   x�u��
�@ �ϻO��k���i�"l��GԌ�˖V��TVO_I���f0���  ~{C���S���\d��A<I!7#�)���pk�\}��N�ti��]�+�k9[�S6�'��:�,[�W� �k#�MhSK�-��� iU	>��ߛ�B��s6flD]����N��f�;�6�|r̜�\�ՠZ{獟�1Z�gi�E�_�U��Si     