INSERT INTO public.pais (id,nombre) VALUES (1,'Colombia');
INSERT INTO public.estado (id,pais_id,nombre) VALUES (1,1,'Antioquia');
INSERT INTO public.ciudad (id,estado_id,nombre) VALUES
	 (1,1,'Sabaneta'),
	 (2,1,'Envigado'),
	 (3,1,'Itagui');
INSERT INTO public.entrega_tipo (id,nombre) VALUES
	 (1,'Caja'),
	 (2,'Sobre'),
	 (3,'Paquete');	 
