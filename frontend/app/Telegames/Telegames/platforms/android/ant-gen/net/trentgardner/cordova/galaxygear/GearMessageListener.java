/*
 * This file is auto-generated.  DO NOT MODIFY.
 * Original file: /home/rbrunne/telegames/frontend/app/Telegames/Telegames/platforms/android/src/net/trentgardner/cordova/galaxygear/GearMessageListener.aidl
 */
package net.trentgardner.cordova.galaxygear;
public interface GearMessageListener extends android.os.IInterface
{
/** Local-side IPC implementation stub class. */
public static abstract class Stub extends android.os.Binder implements net.trentgardner.cordova.galaxygear.GearMessageListener
{
private static final java.lang.String DESCRIPTOR = "net.trentgardner.cordova.galaxygear.GearMessageListener";
/** Construct the stub at attach it to the interface. */
public Stub()
{
this.attachInterface(this, DESCRIPTOR);
}
/**
 * Cast an IBinder object into an net.trentgardner.cordova.galaxygear.GearMessageListener interface,
 * generating a proxy if needed.
 */
public static net.trentgardner.cordova.galaxygear.GearMessageListener asInterface(android.os.IBinder obj)
{
if ((obj==null)) {
return null;
}
android.os.IInterface iin = obj.queryLocalInterface(DESCRIPTOR);
if (((iin!=null)&&(iin instanceof net.trentgardner.cordova.galaxygear.GearMessageListener))) {
return ((net.trentgardner.cordova.galaxygear.GearMessageListener)iin);
}
return new net.trentgardner.cordova.galaxygear.GearMessageListener.Stub.Proxy(obj);
}
@Override public android.os.IBinder asBinder()
{
return this;
}
@Override public boolean onTransact(int code, android.os.Parcel data, android.os.Parcel reply, int flags) throws android.os.RemoteException
{
switch (code)
{
case INTERFACE_TRANSACTION:
{
reply.writeString(DESCRIPTOR);
return true;
}
case TRANSACTION_onConnect:
{
data.enforceInterface(DESCRIPTOR);
int _arg0;
_arg0 = data.readInt();
this.onConnect(_arg0);
reply.writeNoException();
return true;
}
case TRANSACTION_onDataReceived:
{
data.enforceInterface(DESCRIPTOR);
int _arg0;
_arg0 = data.readInt();
java.lang.String _arg1;
_arg1 = data.readString();
this.onDataReceived(_arg0, _arg1);
reply.writeNoException();
return true;
}
case TRANSACTION_onError:
{
data.enforceInterface(DESCRIPTOR);
int _arg0;
_arg0 = data.readInt();
java.lang.String _arg1;
_arg1 = data.readString();
this.onError(_arg0, _arg1);
reply.writeNoException();
return true;
}
}
return super.onTransact(code, data, reply, flags);
}
private static class Proxy implements net.trentgardner.cordova.galaxygear.GearMessageListener
{
private android.os.IBinder mRemote;
Proxy(android.os.IBinder remote)
{
mRemote = remote;
}
@Override public android.os.IBinder asBinder()
{
return mRemote;
}
public java.lang.String getInterfaceDescriptor()
{
return DESCRIPTOR;
}
@Override public void onConnect(int connectionId) throws android.os.RemoteException
{
android.os.Parcel _data = android.os.Parcel.obtain();
android.os.Parcel _reply = android.os.Parcel.obtain();
try {
_data.writeInterfaceToken(DESCRIPTOR);
_data.writeInt(connectionId);
mRemote.transact(Stub.TRANSACTION_onConnect, _data, _reply, 0);
_reply.readException();
}
finally {
_reply.recycle();
_data.recycle();
}
}
@Override public void onDataReceived(int connectionId, java.lang.String data) throws android.os.RemoteException
{
android.os.Parcel _data = android.os.Parcel.obtain();
android.os.Parcel _reply = android.os.Parcel.obtain();
try {
_data.writeInterfaceToken(DESCRIPTOR);
_data.writeInt(connectionId);
_data.writeString(data);
mRemote.transact(Stub.TRANSACTION_onDataReceived, _data, _reply, 0);
_reply.readException();
}
finally {
_reply.recycle();
_data.recycle();
}
}
@Override public void onError(int connectionId, java.lang.String data) throws android.os.RemoteException
{
android.os.Parcel _data = android.os.Parcel.obtain();
android.os.Parcel _reply = android.os.Parcel.obtain();
try {
_data.writeInterfaceToken(DESCRIPTOR);
_data.writeInt(connectionId);
_data.writeString(data);
mRemote.transact(Stub.TRANSACTION_onError, _data, _reply, 0);
_reply.readException();
}
finally {
_reply.recycle();
_data.recycle();
}
}
}
static final int TRANSACTION_onConnect = (android.os.IBinder.FIRST_CALL_TRANSACTION + 0);
static final int TRANSACTION_onDataReceived = (android.os.IBinder.FIRST_CALL_TRANSACTION + 1);
static final int TRANSACTION_onError = (android.os.IBinder.FIRST_CALL_TRANSACTION + 2);
}
public void onConnect(int connectionId) throws android.os.RemoteException;
public void onDataReceived(int connectionId, java.lang.String data) throws android.os.RemoteException;
public void onError(int connectionId, java.lang.String data) throws android.os.RemoteException;
}
