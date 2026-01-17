package com.eventia.demo.dto.eventos;

import java.math.BigDecimal;
import java.sql.Date;
import java.sql.Time;

public class EventoUpdateDTO {
	private String nombre_evento;
	private String descripcion;
	private BigDecimal precio;
	private Date fecha_inicio;
	private Time hora;
	private String ubicacion;
	private String categoria;

	public EventoUpdateDTO(String nombre_evento, String categoria, String descripcion, BigDecimal precio,
			Date fecha_inicio, Date fecha_fin, Time hora, String ubicacion) {
		super();
		this.nombre_evento = nombre_evento;
		this.descripcion = descripcion;
		this.precio = precio;
		this.fecha_inicio = fecha_inicio;
		this.hora = hora;
		this.ubicacion = ubicacion;
		this.categoria = categoria;
	}

	public EventoUpdateDTO() {
		super();
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

	public Time getHora() {
		return hora;
	}

	public void setHora(Time hora) {
		this.hora = hora;
	}

	public String getUbicacion() {
		return ubicacion;
	}

	public void setUbicacion(String ubicacion) {
		this.ubicacion = ubicacion;
	}

	public String getCategoria() {
		return categoria;
	}

	public void setCategoria(String categoria) {
		this.categoria = categoria;
	}
	

}
