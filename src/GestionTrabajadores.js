import React, { useState, useEffect } from 'react';
import './GestionTrabajadores.css';

const GestionProveedores = () => {
    const [proveedores, setProveedores] = useState([]);
    const [formData, setFormData] = useState({
        nombre: '',
        correo_electronico: '',
        telefono: '',
        detalles: '',
    });
    const [isAdding, setIsAdding] = useState(false); // Se usa para mostrar el formulario

    const fetchProveedores = async () => {
        try {
            const response = await fetch('http://localhost/backend/getProveedores.php');
            if (!response.ok) throw new Error('Error al obtener los proveedores');
            const data = await response.json();
            setProveedores(data);
        } catch (error) {
            console.error('Error fetching proveedores:', error);
        }
    };

    useEffect(() => {
        fetchProveedores();
    }, []);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const { nombre, correo_electronico, telefono, detalles } = formData;

        console.log('Form data being submitted:', formData);  // Log para verificar los datos

        try {
            const url = isAdding
                ? 'http://localhost/backend/addProveedor.php'
                : 'http://localhost/backend/updateProveedor.php';

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ nombre, correo_electronico, telefono, detalles }),
            });

            const result = await response.json();
            if (result.status === "success") {
                fetchProveedores();
                console.log('Proveedor actualizado');
            } else {
                console.error('Error:', result.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }

        // Limpiar el formulario después de enviar
        setFormData({ nombre: '', correo_electronico: '', telefono: '', detalles: '' });
    };

    const handleDelete = async (nombre) => {
        try {
            const response = await fetch('http://localhost/backend/deleteProveedor.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ nombre }),
            });

            const result = await response.json();
            if (result.status === "success") fetchProveedores();
            else console.error('Error eliminando proveedor:', result.message);
        } catch (error) {
            console.error('Error eliminando proveedor:', error);
        }
    };

    const toggleForm = () => {
        setIsAdding(!isAdding); // Cambiar el estado de "Agregar/Editar"
        setFormData({ nombre: '', correo_electronico: '', telefono: '', detalles: '' }); // Limpiar el formulario
    };

    const handleEdit = (proveedor) => {
        setFormData({
            nombre: proveedor.Nombre,
            correo_electronico: proveedor.Correo_Electronico,
            telefono: proveedor.Telefono,
            detalles: proveedor.Detalles,
        });
        setIsAdding(false); // Mostrar el formulario de edición en lugar de agregar
    };

    return (
        <div id="container" className="animate__animated animate__fadeIn">
            <h2 id="title">Registro de Proveedores</h2>

            {/* Mostrar el botón para agregar proveedor solo si no está en el modo de edición */}
            {!isAdding && (
                <button id="btn-add" onClick={toggleForm}>Agregar Proveedor</button>
            )}

            {/* Mostrar el formulario ya sea para agregar o editar */}
            {(isAdding || !isAdding) && (
                <form id="form-add-update" onSubmit={handleSubmit}>
                    <label id="label-nombre">Nombre del Proveedor:</label>
                    <input id="input-nombre" type="text" name="nombre" value={formData.nombre} onChange={handleChange} required />

                    <label id="label-correo_electronico">Correo Electrónico:</label>
                    <input id="input-correo_electronico" type="email" name="correo_electronico" value={formData.correo_electronico} onChange={handleChange} required />

                    <label id="label-telefono">Teléfono:</label>
                    <input id="input-telefono" type="tel" name="telefono" value={formData.telefono} onChange={handleChange} required />

                    <label id="label-detalles">Detalles:</label>
                    <input id="input-detalles" type="text" name="detalles" value={formData.detalles} onChange={handleChange} required />

                    <input id="submit-agregar" type="submit" value={isAdding ? "Agregar" : "Actualizar"} />
                    <button type="button" id="btn-regresar" onClick={toggleForm}>Regresar</button>
                </form>
            )}

            {/* Tabla de proveedores */}
            {!isAdding && (
                <table id="tabla-proveedores">
                    <thead>
                        <tr>
                            <th id="th-nombre">Nombre</th>
                            <th id="th-correo_electronico">Correo Electrónico</th>
                            <th id="th-telefono">Teléfono</th>
                            <th id="th-detalles">Detalles</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {proveedores.map(proveedor => (
                            <tr key={proveedor.N_proveedor}>
                                <td id={`td-nombre-${proveedor.N_proveedor}`}>{proveedor.Nombre}</td>
                                <td id={`td-correo_electronico-${proveedor.N_proveedor}`}>{proveedor.Correo_Electronico}</td>
                                <td id={`td-telefono-${proveedor.N_proveedor}`}>{proveedor.Telefono}</td>
                                <td id={`td-detalles-${proveedor.N_proveedor}`}>{proveedor.Detalles}</td>
                                <td>
                                    <button id={`btn-eliminar-${proveedor.N_proveedor}`} onClick={() => handleDelete(proveedor.Nombre)}>Eliminar</button>
                                    <button id={`btn-editar-${proveedor.N_proveedor}`} onClick={() => handleEdit(proveedor)}>Editar</button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
};

export default GestionProveedores;
