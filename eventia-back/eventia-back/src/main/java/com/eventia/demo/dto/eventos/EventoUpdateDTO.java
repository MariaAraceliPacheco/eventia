package com.eventia.demo.dto.eventos;

import java.math.BigDecimal;
import java.sql.Date;

public class EventoUpdateDTO {
	private String nombre_evento;
	private String descripcion;
	private BigDecimal precio;
	private Date fecha_inicio;
	private String localidad;
	private String provincia;
	private String categoria;

	public EventoUpdateDTO(String nombre_evento, String descripcion, BigDecimal precio, Date fecha_inicio,
			String localidad, String provincia, String categoria) {
		super();
		this.nombre_evento = nombre_evento;
		this.descripcion = descripcion;
		this.precio = precio;
		this.fecha_inicio = fecha_inicio;
		this.localidad = localidad;
		this.provincia = provincia;
		this.categoria = categoria;
	}

	public EventoUpdateDTO() {
		super();
	}

	public String getLocalidad() {
		return localidad;
	}

	public void setLocalidad(String localidad) {
		this.localidad = localidad;
	}

	public String getProvincia() {
		return provincia;
	}

	public void setProvincia(String provincia) {
		this.provincia = provincia;
	}

	public String getNombre_evento() {
		return nombre_evento;
	}

	public void setNombre_evento(String nombre_evento) {
		this.nombre_evento = nombre_evento;
	}

	public String getDescripcion() {
		return descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
	}

	public BigDecimal getPrecio() {
		return precio;
	}

	public void setPrecio(BigDecimal precio) {
		this.precio = precio;
	}

	public Date getFecha_inicio() {
		return fecha_inicio;
	}

	public void setFecha_inicio(Date fecha_inicio) {
		this.fecha_inicio = fecha_inicio;
	}

	public String getCategoria() {
		return categoria;
	}

	public void setCategoria(String categoria) {
		this.categoria = categoria;
	}

}
